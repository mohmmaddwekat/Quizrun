<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Models\Admin\Admin;
use App\Models\Country;
use App\Models\Teacher;
use App\Notifications\NewMessageNotification;
use App\Providers\TeacherRouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
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
        $this->teacherAuthTemplate('register', 'Register',['country'=>$country]);
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => 'image|mimes:jpg,jpeg,png',
            'certificate' => 'required|image|mimes:jpg,jpeg,png',
            'job' => ['required', 'string','min:2','max:255'],
            'skills' => ['required', 'string','min:2','max:255'],
            'location' => ['required', 'exists:countries,id'],
            'education' => ['required', 'string','min:2','max:255'],
            'experience' => ['required', 'string','min:2','max:255'],
        ]);

        $path_image = null;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $path_certificate = null;
        if ($request->hasFile('certificate') && $request->File('certificate')->isValid()) {
            $file = $request->file('certificate');
            $path_certificate = $file->store('img', 'uploads');
        }

        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $path_image,
            'job'=>$request->job,
            'skills' => $request->skills,
            'location_id' => $request->location,
            'education' => $request->education,
            'experience' => $request->experience,
            'certificate' => $path_certificate,
            'password' => Hash::make($request->password),

        ]);
        $admin = Admin::where('name', 'superAdmin')->first();
        $admin->NewMessageNotification('Certificate review', 'Check the certificate sent by ' . $request->name, Teacher::class, $teacher, route('admin.teacher.show', $teacher->id));
        return redirect()->route('teacher.auth.login');
    }
}
