<?php

namespace App\Http\Controllers\Student\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmablePasswordController extends AuthController
{
    /**
     * Show the confirm password view.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show()
    {
        $this->studentAuthTemplate('confirm-password', __('Confirm Password'));
    }


    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (!Auth::guard('student')->validate([
            'email' => $request->user('student')->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('student.auth.password_confirmed_at', time());

        return redirect()->route('student.auth.confirm-password');
    }
}
