<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function checkUsername(Request $request)
    {
        $username = strip_tags(clean($request->username));
        if (User::where('username', $username)->exists()) {
            return response()->json('taken');
        } else {
            return response()->json('available');
        }
    }
}
