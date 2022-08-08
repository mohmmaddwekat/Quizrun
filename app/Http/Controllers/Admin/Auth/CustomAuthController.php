<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Providers\AdminRouteServiceProvider;
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
        return $this->adminAuthTemplate('login', __('Log in'));
    }



    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate('admin');

        $request->session()->regenerate();

        return redirect()->intended(AdminRouteServiceProvider::HOME);


    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.auth.login');
    }
}
