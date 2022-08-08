<?php

namespace App\Http\Controllers\Student\Auth;

use App\Providers\StudentRouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends AuthController
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user('student')->hasVerifiedEmail()
            ? redirect()->intended(StudentRouteServiceProvider::HOME)
            : $this->studentAuthTemplate('verify-email', __('Verify Email'));
    }
}
