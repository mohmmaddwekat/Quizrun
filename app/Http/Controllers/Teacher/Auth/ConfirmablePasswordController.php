<?php

namespace App\Http\Controllers\Teacher\Auth;

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
        $this->teacherAuthTemplate('confirm-password', __('Confirm Password'));
    }


    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {
        if (!Auth::guard('teacher')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('teacher.auth.password_confirmed_at', time());

        return redirect()->route('teacher.auth.confirm-password');
    }
}
