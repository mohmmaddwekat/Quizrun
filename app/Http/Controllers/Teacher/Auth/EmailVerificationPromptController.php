<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Providers\RouteServiceProvider;
use App\Providers\TeacherRouteServiceProvider;
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
        return $request->user('teacher')->hasVerifiedEmail()
            ? redirect()->intended(TeacherRouteServiceProvider::HOME)
            : $this->teacherAuthTemplate('verify-email', __('Verify Email'));
    }
}
