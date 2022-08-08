<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class UserStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = User::all();
        $this->adminTemplate('student.index', __('Students'), ['students' => $students]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $country = Country::all();
        return $this->adminTemplate('student.add', __('Add Student'),['country'=>$country]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'unique:admins', 'unique:teachers'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'isbanned' => 'in:on,off',
            'image' => 'image|mimes:jpg,jpeg,png',
            'job' => ['required', 'string','min:2','max:255'],
            'skills' => ['required', 'string','min:2','max:255'],
            'location' => ['required', 'exists:countries,id'],
            'education' => ['required', 'string','min:2','max:255'],
        ]);
        $path_image = null;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $isBanned = 0;
        if ($request->post('isbanned') == 'on') {
            $isBanned = 1;
        }
        $student = new User;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->job = $request->job;
        $student->skills = $request->skills;
        $student->location_id = $request->location;
        $student->education = $request->education;
        $student->image = $path_image;
        $student->isbanned = $isBanned;
        $student->password = Hash::make($request->post('password'));
        if (!$student->save()) {
            if ($path_image != null) {
                Storage::disk('uploads')->delete($path_image);
            }
            return redirect()->route('admin.student.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('admin.student.index')->with('Success', __('Add success'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $student = User::find($id);
        $country = Country::all();
        if ($student == null) {
            return redirect()->route('admin.student.index')->with('Error', __('Not Fond') . ' ' . __('Students'));
        } else {
            $this->adminTemplate('student.edit', __('Edit Student'), [
                'student' => $student,
                'country' => $country,
            ]);
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
            'job' => ['required', 'string','min:2','max:255'],
            'skills' => ['required', 'string','min:2','max:255'],
            'location' => ['required', 'exists:countries,id'],
            'education' => ['required', 'string','min:2','max:255'],
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
            return redirect()->route('admin.student.index')->with('Error', __('an error occurred'));
        }
        if ($old_path_image && $old_path_image != $path_image) {
            Storage::disk('uploads')->delete($old_path_image);
        }
        return redirect()->route('admin.student.index')->with('Success', __('Edit success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $student = User::find($id);
        if ($student == null) {
            return redirect()->route('admin.student.index')->with('Error', __('Not Fond') . ' ' . __('Students'));
        }
        $student->delete();
        $student->groups()->detach();
        $student->messages()->detach();
        if ($student->image) {
            Storage::disk('uploads')->delete($student->image);
        }
        return redirect()->route('admin.student.index')->with('Success', __('delete success'));
    }
}
