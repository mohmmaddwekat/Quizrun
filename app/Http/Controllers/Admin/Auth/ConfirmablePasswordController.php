<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Providers\AdminRouteServiceProvider;
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
        $this->adminAuthTemplate('confirm-password',__('Confirm Password'));
    }
    

    /**
     * Confirm the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {

        if (! Auth::guard('admin')->validate([
            'email' => $request->user('admin')->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('admin.auth.password_confirmed_at', time());

        return redirect()->intended(AdminRouteServiceProvider::HOME);
    }
}
