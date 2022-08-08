<?php

namespace App\Http\Controllers\Student\Auth;

use App\Models\Country;
use App\Models\User;
use App\Providers\StudentRouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends AuthController
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $country = Country::all();
        $this->studentAuthTemplate('register', __('Register'),['country'=>$country]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:teachers', 'unique:admins', 'unique:users'],
            'job' => ['required', 'string','min:2','max:255'],
            'skills' => ['required', 'string','min:2','max:255'],
            'location' => ['required', 'exists:countries,id'],
            'education' => ['required', 'string','min:2','max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);
        $path_image = null;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'job' => $request->job,
            'skills' => $request->skills,
            'location_id' => $request->location,
            'education' => $request->education,
            'image' => $path_image,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('student')->login($user);

        return redirect(StudentRouteServiceProvider::HOME);
    }
}
