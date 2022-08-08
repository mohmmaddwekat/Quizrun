<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class UserTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $teachers = Teacher::all();
        $this->adminTemplate('teacher.index', __('Teachers'), ['teachers' => $teachers]);
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
        return $this->adminTemplate('teacher.add', __('Add Teacher'), ['country' => $country]);
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:teachers', 'unique:admins', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'isactive' => 'in:on,off',
            'image' => 'image|mimes:jpg,jpeg,png',
            'job' => ['required', 'string', 'min:2', 'max:255'],
            'skills' => ['required', 'string', 'min:2', 'max:255'],
            'location' => ['required', 'exists:countries,id'],
            'education' => ['required', 'string', 'min:2', 'max:255'],
            'experience' => ['required', 'string', 'min:2', 'max:255'],
        ]);
        $path_image = null;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $isactive = 0;
        if ($request->isactive == 'on') {
            $isactive = 1;
        }
        $teacher = new Teacher;
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->job = $request->job;
        $teacher->skills = $request->skills;
        $teacher->location_id = $request->location;
        $teacher->education = $request->education;
        $teacher->experience = $request->experience;
        $teacher->image = $path_image;
        $teacher->isactive = $isactive;
        $teacher->password = Hash::make($request->post('password'));
        if (!$teacher->save()) {
            if ($path_image != null) {
                Storage::disk('uploads')->delete($path_image);
            }
            return redirect()->route('admin.teacher.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('admin.teacher.index')->with('Success', __('Add success'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $teacher = Teacher::find($id);
        $this->adminTemplate('teacher.show', __('Show Certificate'), ['teacher' => $teacher]);
    }

    /**
     * Teacher's approval.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approval(Request $request, $id)
    {
        //
        $request->validate([
            'isactive' => 'in:on,off',
        ]);
        $teacher = Teacher::find($id);
        $isactive = $teacher->isactive;
        if ($request->post('isactive') != null) {
            if ($request->post('isactive') == 'on') {
                $isactive = 1;
            } elseif ($request->post('isactive') == 'off') {
                $isactive = 0;
            }
        }
        $teacher->isactive = $isactive;
        if (!$teacher->save()) {
            return redirect()->route('admin.teacher.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('admin.teacher.index')->with('Success', __('Edit success'));
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
        $teacher = Teacher::find($id);
        $country = Country::all();
        if ($teacher == null) {
            return redirect()->route('admin.teacher.index')->with('Error', __('Not Fond') . ' ' . __('Teachers'));
        } else {
            $this->adminTemplate('teacher.edit', __('Edit Teacher'), [
                'teacher' => $teacher,
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
            return redirect()->route('admin.teacher.index')->with('Error', __('an error occurred'));
        }
        if ($old_path_image && $old_path_image != $path_image) {
            Storage::disk('uploads')->delete($old_path_image);
        }
        return redirect()->route('admin.teacher.index')->with('Success', __('Edit success'));
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
        $teacher = Teacher::find($id);
        if ($teacher == null) {
            return redirect()->route('admin.teacher.index')->with('Error', __('Not Fond') . ' ' . __('Teachers'));
        }
        $teacher->delete();

        if ($teacher->image)         $teacher->notifications()->detach();
        $teacher->messages()->detach();
        $teacher->group()->detach();{
            Storage::disk('uploads')->delete($teacher->image);
        }
        if ($teacher->certificate) {
            Storage::disk('uploads')->delete($teacher->certificate);
        }
        return redirect()->route('admin.teacher.index')->with('Success', __('delete success'));
    }
}
