<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $clearedFields = [
            'username' => strip_tags(clean($request->username)),
            'email' => strip_tags(clean($request->email)),
            'password' => strip_tags(clean($request->password)),
            'password_confirmation' => strip_tags(clean($request->password)),
        ];

        $validator = Validator::make($clearedFields, [
            'username' => ['unique:users', 'required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = User::create([
            'username' => $clearedFields['username'],
            'email' => $clearedFields['email'],
            'password' => Hash::make($clearedFields['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::BROWSE);
    }
}
