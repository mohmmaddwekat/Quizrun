<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Providers\TeacherRouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use App\Http\Requests\Auth\TeacherEmailVerificationRequest;

class VerifyEmailController extends AuthController
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  App\Http\Requests\Auth\TeacherEmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(TeacherEmailVerificationRequest $request)
    {
        if ($request->user('teacher')->hasVerifiedEmail()) {
            return redirect()->intended(TeacherRouteServiceProvider::HOME . '?verified=1');
        }

        if ($request->user('teacher')->markEmailAsVerified()) {
            event(new Verified($request->user('teacher')));
        }
        return redirect()->intended(TeacherRouteServiceProvider::HOME . '?verified=1');
    }
}
