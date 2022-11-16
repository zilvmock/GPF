<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $user = User::where('username', $request->user)->firstOrFail();
        return view('profile', [
            'user' => $user
        ]);
    }
}
