<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Providers\TeacherRouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return $this->teacherAuthTemplate('login', __('Log in'));
    }



    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
         $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        $email = $request->email;
        $password = $request->password;
        if (!Auth::guard('teacher')->attempt(['email' => $email, 'password' => $password], $request->boolean('remember-me'))) {
            return redirect()->route('teacher.auth.login')->with('erorr', __('Login details are not valid'));
        }
        if (Auth::guard('teacher')->user()->isactive == false) {
            Auth::guard('teacher')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            return redirect()->route('teacher.auth.login')->with('erorr', __('Wait for your account to be confirmed'));
        }
        $request->session()->regenerate();
        return redirect()->intended(TeacherRouteServiceProvider::HOME);


        $request->authenticate('teacher');

        $request->session()->regenerate();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('teacher')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('teacher.auth.login');
    }
}
