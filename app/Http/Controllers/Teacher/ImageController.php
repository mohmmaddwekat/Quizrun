<?php

namespace App\Http\Controllers\Teacher;

use App\Models\teacher\Image;
use App\Models\Teacher\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $images = Image::all();
        $this->teacherTemplate('image.index', __('Images'), ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sections = Section::all();
        $this->teacherTemplate('image.add', __('Add Image'), [
            'sections' => $sections,
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
            'image' => 'image|mimes:jpg,jpeg,png',
            'section' =>['required', 'exists:sections,id']
        ]);
        $path_image = null;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $image = new Image;
        $image->image = $path_image;
        $image->section_id = $request->post('section');
        if (!$image->save()) {
            if ($path_image != null) {
                Storage::disk('uploads')->delete($path_image);
            }
            return redirect()->route('teacher.image.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('teacher.image.index')->with('Success', __('Add success'));
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
        $image = Image::find($id);
        if ($image == null) {
            return redirect()->route('teacher.image.index')->with('Error', __('Not Fond') . ' ' . __('image'));
        } else {
            $section_image = $image->section()->pluck('id')->toArray();
            $sections = Section::all();
            $this->teacherTemplate('image.edit', __('Edit Image'), [
                'image' => $image,
                'sections' => $sections,
                'section_image' => $section_image,
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
            'image' => 'image|mimes:jpg,jpeg,png',
            'section' =>['required', 'exists:sections,id']
        ]);
        $image = Image::find($id);
        $path_image = $image->image;
        $old_path_image = $image->image;
        if ($request->hasFile('image') && $request->File('image')->isValid()) {
            $file = $request->file('image');
            $path_image = $file->store('img', 'uploads');
        }
        $image->image = $path_image;
        $image->section_id = $request->post('section');
        if (!$image->save()) {
            return redirect()->route('teacher.image.index')->with('Error', __('an error occurred'));
            if ($path_image != $old_path_image) {
                Storage::disk('uploads')->delete($path_image);
            }
        }
        if ($old_path_image && $old_path_image != $path_image) {
            Storage::disk('uploads')->delete($old_path_image);
        }
        return redirect()->route('teacher.image.index')->with('Success', __('Edit success'));
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
        $image = Image::find($id);
        if ($image == null) {
            return redirect()->route('teacher.image.index')->with('Error', __('Not Fond') . ' ' . __('image'));
        }
        $image->delete();
        Storage::disk('uploads')->delete($image->image);
        return redirect()->route('teacher.image.index')->with('Success', __('delete success'));
    }
}
