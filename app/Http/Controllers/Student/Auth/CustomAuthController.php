<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\StudentRouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class CustomAuthController extends AuthController
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->studentAuthTemplate('login', __('Log in'));
    }



    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate('student');

        $request->session()->regenerate();

        return redirect()->intended(StudentRouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('student.auth.login');
    }




}
