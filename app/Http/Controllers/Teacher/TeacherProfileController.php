<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Country;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $teacher = Teacher::find($id);
        $country = Country::all();
        if ($teacher == null) {
            return redirect()->route('teacher.profile')->with('Error', __('Not Fond') . ' ' . __('Teachers'));
        } else {
            if ($teacher->id == auth('teacher')->id()) {
                $this->teacherTemplate('profile.myprofile', __('Profile'), [
                    'teacher' => $teacher,
                    'country' => $country,
                ]);
            } else {
                $this->teacherTemplate('profile.teacher', __('Profile'), [
                    'teacher' => $teacher,
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:teachers,email,' . $id, 'unique:admins', 'unique:users'],
            'password' => ['confirmed'],
            'isactive' => 'in:on,off',
            'image' => 'image|mimes:jpg,jpeg,png',
            'job' => ['required', 'string', 'min:2', 'max:255'],
            'skills' => ['required', 'string', 'min:2', 'max:255'],
            'location' => ['required', 'exists:countries,id'],
            'education' => ['required', 'string', 'min:2', 'max:255'],
            'experience' => ['required', 'string', 'min:2', 'max:255'],
        ]);
        $teacher = Teacher::find($id);

        $password = $teacher->password;
        if ($request->post('password') != null) {
            $password = Hash::make($request->password);
        }
        $path_image = $teacher->image;
        $old_path_image = $teacher->image;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $isactive = $teacher->isactive;
        if ($request->post('isactive') != null) {
            if ($request->post('isactive') == 'on') {
                $isactive = 1;
            } elseif ($request->post('isactive') == 'off') {
                $isactive = 0;
            }
        }
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->job = $request->job;
        $teacher->skills = $request->skills;
        $teacher->location_id = $request->location;
        $teacher->education = $request->education;
        $teacher->experience = $request->experience;
        $teacher->password = $password;
        $teacher->image = $path_image;
        $teacher->isactive = $isactive;
        if (!$teacher->save()) {
            if ($path_image != $old_path_image) {
                Storage::disk('uploads')->delete($path_image);
            }
            return redirect()->route('teacher.profile.erit',$teacher->id)->with('Error', __('an error occurred'));
        }
        if ($old_path_image && $old_path_image != $path_image) {
            Storage::disk('uploads')->delete($old_path_image);
        }
        return redirect()->route('teacher.profile.edit',$teacher->id)->with('Success', __('Edit success'));
    }
}
