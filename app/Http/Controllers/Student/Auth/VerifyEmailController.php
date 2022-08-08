<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Requests\Auth\StudentEmailVerificationRequest;
use App\Providers\StudentRouteServiceProvider;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends AuthController
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  App\Http\Requests\Auth\StudentEmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(StudentEmailVerificationRequest $request)
    {
        if ($request->user('student')->hasVerifiedEmail()) {
            return redirect()->intended(StudentRouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user('student')->markEmailAsVerified()) {
            event(new Verified($request->user('student')));
        }
        return redirect()->intended(StudentRouteServiceProvider::HOME.'?verified=1');
    }
}
