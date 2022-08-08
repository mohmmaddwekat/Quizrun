<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Admin\Category;
use App\Models\Forum;
use App\Models\Teacher;
use App\Models\Teacher\Group;
use App\Models\User;
use App\Rules\alpha_spaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $groups = Group::all();
        $this->teacherTemplate('group.index', __('Groups'), ['groups' => $groups]);
    }

    /**
     * member of Group 
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function member($id)
    {
        //
        $group = Group::find($id);
        return $this->teacherTemplate('group.member',__('Members'),['group'=>$group,'teachers'=>$group->teacher()->get(),'students'=>$group->users()->paginate(5)]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $this->teacherTemplate('group.add', __('Add Group'), [
            'categories' => $categories,
        ]);
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
            'name' => ['required', new alpha_spaces, 'unique:groups', 'min:2', 'max:255'],
            'categories' => ['required', 'exists:categories,id'],
            'description' => 'max:255',
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);
        $path_image = null;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        DB::beginTransaction();
        try {
            $group = Group::create([
                'name' => $request->post('name'),
                'description' => $request->post('description'),
                'category_id' => $request->post('categories'),
                'teacher_id' => auth::guard('teacher')->user()->id,
                'image' => $path_image,
            ]);
            $group->forum()->create([]);
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            return redirect()->route('teacher.group.index')->with('Error', __($th->getMessage()));
        }
        $students = User::all();
        $teacher = Auth::guard('teacher')->user();
        foreach ($students as $student) {
            $student->NewMessageNotification('New Group','A new group called '. $group->name .' has been created by '.$teacher->name.', would you like to join it?', Teacher::class, $teacher, route('student.group.show', $group->id));
        }
        return redirect()->route('teacher.group.index')->with('Success', __('Add success'));
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
        $group = Group::find($id);
        if ($group == null) {
            return redirect()->route('teacher.group.index')->with('Error', __('Not Fond') . ' ' . __('Group'));
        } else {
            $category_group = $group->category()->pluck('id')->toArray();
            $categories = Category::all();
            $this->teacherTemplate('group.edit', __('Edit Group'), [
                'group' => $group,
                'categories' => $categories,
                'category_group' => $category_group,
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
            'name' => ['required', new alpha_spaces, 'unique:groups,name,' . $id, 'min:2', 'max:255'],
            'categories' => ['required', 'exists:categories,id'],
            'description' => 'max:255',
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);
        $group = Group::find($id);
        $path_image = $group->image;
        $old_path_image = $group->image;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $group->name = $request->post('name');
        $group->description = $request->post('description');
        $group->category_id = $request->post('categories');
        $group->teacher_id = auth::guard('teacher')->user()->id;
        $group->image = $path_image;
        if (!$group->save()) {
            if ($path_image != $old_path_image) {
                Storage::disk('uploads')->delete($path_image);
            }
            return redirect()->route('teacher.group.index')->with('Error', __('an error occurred'));
        }
        if ($old_path_image && $old_path_image != $path_image) {
            Storage::disk('uploads')->delete($old_path_image);
        }
        return redirect()->route('teacher.group.index')->with('Success', __('Edit success'));
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
        $group = Group::find($id);
        if ($group == null) {
            return redirect()->route('teacher.group.index')->with('Error', __('Not Fond') . ' ' . __('group'));
        }
        if ($group->forum()->get() ==null) {
            return redirect()->route('teacher.group.index')->with('Error', __('It cannot be deleted because it is related to something else'));
        }
        if ($group->teacher()->get() ==null) {
            return redirect()->route('teacher.group.index')->with('Error', __('It cannot be deleted because it is related to something else'));
        }
        if ($group->courses()->get() ==null) {
            return redirect()->route('teacher.group.index')->with('Error', __('It cannot be deleted because it is related to something else'));
        }
        if ($group->users()->get() == null) {
            return redirect()->route('teacher.group.index')->with('Error', __('It cannot be deleted because it is related to something else'));
        }
        $group->delete();
        Storage::disk('uploads')->delete($group->image);
        return redirect()->route('teacher.group.index')->with('Success', __('delete success'));
    }
}
