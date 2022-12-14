<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use App\Models\User;
use App\Rules\NotURLInvokableRule;
use App\Rules\UsernameCanBeChangedInvokableRule;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $user = User::where('username', $request->user)->firstOrFail();
        return view('profile', [
            'user' => $user
        ]);
    }

    public function showEditProfile()
    {
       return view('edit-profile');
    }

    public function updateProfile(Request $request)
    {
        if ($request->user()->id != auth()->id()) {
            abort(403, 'Unauthorized action');
        } else {
            $user = $request->user();
        }

        $fields = [
            'username' => strip_tags(clean($request->username)),
            'email' => strip_tags(clean($request->email)),
            'password' => strip_tags(clean($request->password)),
            'password_confirmation' => strip_tags(clean($request->password_confirmation)),
        ];

        /* Ignore if fields hasn't changed */
        if ($user->username == $request->username) {
            Arr::forget($fields, ['username']);
        }
        if ($user->email == $request->email) {
            Arr::forget($fields, ['email']);
        }
        if (empty($request->password) || empty($request->password_confirmation)) {
            Arr::forget($fields, ['password', 'password_confirmation']);
        }
        $temporaryFile = TemporaryFile::where('folder', $request->avatar)->first();
        if (empty($fields) && !$temporaryFile) {
            return back();
        }

        $validator = Validator::make($fields, [
            'username' => ['max:16', 'min:4', 'unique:users,username', new usernameCanBeChangedInvokableRule],
            'email' => ['max:32', 'min:4', 'email', 'unique:users,email'],
            'password' => ['required_with:password_confirmation', 'max:32', 'min:6'],
            'password_confirmation' => ['max:32', 'min:6', 'same:password'],
        ], [
            'required' => 'The :attribute field can not be blank!',
        ]);

        if ($validator->passes()) {
            if ($temporaryFile) {
                rename(
                    storage_path('app/public/avatars/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename),
                    storage_path('app/public/avatars/' . $temporaryFile->filename)
                );
                $fields['avatar'] = $temporaryFile->filename;
                rmdir(storage_path('app/public/avatars/tmp/' . $request->avatar));
                $temporaryFile->delete();
            }
            if (array_key_exists('password', $fields)) {
                Arr::forget($fields, ['password_confirmation']);
                $fields['password'] = Hash::make($fields['password']);
            }
            if (array_key_exists('username', $fields)) {
                $fields['username_changed_at'] = Carbon::now()->toDateTimeString();
            }

            $email = '';
            if (array_key_exists('email', $fields)) {
                $email = $fields['email'];
                Arr::forget($fields, ['email']);
            }
            User::where('id', $user->id)->update($fields);
            if (!empty($email) && $user->email != $email) {
                $user->newEmail($email);
            }

            return back()->with('success', __('Profile has been updated!'));
        } else {
            return back()->withErrors($validator)->with('error', __('Failed to update profile!'));
        }
    }

    public function updateProfileAccounts(Request $request)
    {
        if ($request->user()->id != auth()->id()) {
            abort(403, 'Unauthorized action');
        } else {
            $user = $request->user();
        }

        $fields = [
            'steam_usr' => strip_tags(clean($request->steam_usr)),
            'epic_usr' => strip_tags(clean($request->epic_usr)),
            'origin_usr' => strip_tags(clean($request->origin_usr)),
            'xbox_usr' => strip_tags(clean($request->xbox_usr)),
        ];

        $fields = array_filter($fields, function($value) { return $value !== ''; });

        $validator = Validator::make($fields, [
            'steam_usr','epic_usr','origin_usr','xbox_usr' => ['max:64', 'min:4', new NotURLInvokableRule()],
        ]);

        if ($validator->passes()) {
            User::where('id', $user->id)->update($fields);
            return back()->with('success', __('Profile has been updated!'));
        } else {
            return back()->withErrors($validator)->with('error', __('Failed to update profile!'));
        }
    }
}
