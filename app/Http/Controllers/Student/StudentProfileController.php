<?php

namespace App\Http\Controllers\Student;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $student = User::find($id);
        $country = Country::all();
        if ($student == null) {
            return redirect()->route('student.profile')->with('Error', __('Not Fond') . ' ' . __('Students'));
        } else {
            if ($student->id == auth('student')->id()) {
                $this->StudentTemplate('profile.myprofile', __('Profile'), [
                    'student' => $student,
                    'country' => $country,
                ]);
            } else {
                $this->StudentTemplate('profile.student', __('Profile'), [
                    'student' => $student,
                ]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id, 'unique:teachers', 'unique:admins'],
            'password' => ['confirmed'],
            'isbanned' => 'in:on,off',
            'image' => 'image|mimes:jpg,jpeg,png',
            'job' => ['required', 'string', 'min:2', 'max:255'],
            'skills' => ['required', 'string', 'min:2', 'max:255'],
            'location' => ['required', 'exists:countries,id'],
            'education' => ['required', 'string', 'min:2', 'max:255'],
        ]);
        $student = User::find($id);
        $password = $student->password;
        if ($request->post('password') != null) {
            $password = Hash::make($request->password);
        }
        $path_image = $student->image;
        $old_path_image = $student->image;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $isBanned = $student->isbanned;
        if ($request->post('isbanned') != null) {
            if ($request->post('isbanned') == 'on') {
                $isBanned = 1;
            } elseif ($request->post('isbanned') == 'off') {
                $isBanned = 0;
            }
        }
        $student->name = $request->name;
        $student->email = $request->email;
        $student->job = $request->job;
        $student->skills = $request->skills;
        $student->location_id = $request->location;
        $student->education = $request->education;
        $student->password = $password;
        $student->image = $path_image;
        $student->isbanned = $isBanned;
        if (!$student->save()) {
            if ($path_image != $old_path_image) {
                Storage::disk('uploads')->delete($path_image);
            }
            return redirect()->route('student.profile.index',$student->id)->with('Error', __('an error occurred'));
        }
        if ($old_path_image && $old_path_image != $path_image) {
            Storage::disk('uploads')->delete($old_path_image);
        }
        return redirect()->route('student.profile.index',$student->id)->with('Success', __('Edit success'));
    }
}
