<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Providers\TeacherRouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends AuthController
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user('teacher')->hasVerifiedEmail()) {
            return redirect()->intended(TeacherRouteServiceProvider::HOME);
        }

        $request->user('teacher')->sendEmailVerificationNotification('teacher');

        return back()->with('status', 'verification-link-sent');
    }
}
