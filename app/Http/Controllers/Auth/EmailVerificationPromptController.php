<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasPendingVerification($request->user()->id)) {
            return view('auth.verify-new-email');
        } elseif (!$request->user()->hasVerifiedEmail()) {
            return view('auth.verify-email');
        }
        return redirect()->intended(RouteServiceProvider::BROWSE);
//        return $request->user()->hasVerifiedEmail()
//            ? redirect()->intended(RouteServiceProvider::BROWSE)
//            : view('auth.verify-email');
    }
}
