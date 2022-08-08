<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::all();
        $this->adminTemplate('admin.index', __('Admins'), ['admins' => $admins]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return $this->adminTemplate('admin.add', __('Add Admin'));
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins', 'unique:teachers', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);
        $path_image = null;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $admin = new Admin;
        $admin->name = $request->post('name');
        $admin->image = $path_image;
        $admin->email = $request->post('email');
        $admin->password = Hash::make($request->post('password'));
        if (!$admin->save()) {
            if ($path_image != null) {
                Storage::disk('uploads')->delete($path_image);
            }
            return redirect()->route('admin.admins.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('admin.admins.index')->with('Success', __('Add success'));
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
        $admin = Admin::find($id);
        if ($admin == null) {
            return redirect()->route('admin.admins.index')->with('Error', __('Not Fond') . ' ' . __('Admins'));
        } else {
            $this->adminTemplate('admin.edit', __('Edit Admin'), [
                'admin' => $admin,
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $id, 'unique:teachers', 'unique:users'],
            'password' => ['confirmed'],
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);
        $admin = Admin::find($id);
        $path_image = $admin->image;
        $old_path_image = $admin->image;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $password = $admin->password;
        if ($request->post('password') != null) {
            $password = Hash::make($request->password);
        }
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = $password;
        $admin->image = $path_image;
        if (!$admin->save()) {
            if ($path_image != $old_path_image) {
                Storage::disk('uploads')->delete($path_image);
            }
            return redirect()->route('admin.admins.index')->with('Error', __('an error occurred'));
        }
        if ($old_path_image && $old_path_image != $path_image) {
            Storage::disk('uploads')->delete($old_path_image);
        }
        return redirect()->route('admin.admins.index')->with('Success', __('Edit success'));
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
        $admin = Admin::find($id);
        if ($admin == null) {
            return redirect()->route('admin.admins.index')->with('Error', __('Not Fond') . ' ' . __('Admins'));
        }
        $admin->delete();
        if ($admin->image) {
            Storage::disk('uploads')->delete($admin->image);
        }
        return redirect()->route('admin.admins.index')->with('Success', __('delete success'));
    }
}
