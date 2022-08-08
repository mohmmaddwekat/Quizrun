<?php

namespace App\Http\Controllers\Student\Auth;

use App\Providers\StudentRouteServiceProvider;
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
        if ($request->user('student')->hasVerifiedEmail()) {
            return redirect()->intended(StudentRouteServiceProvider::HOME);
        }

        $request->user('student')->sendEmailVerificationNotification('student');

        return back()->with('status', 'verification-link-sent');
    }
}
