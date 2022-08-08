<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Teacher\Section;
use App\Models\teacher\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $videos = Video::all();
        $this->teacherTemplate('video.index', __('Videos'), ['videos' => $videos]);
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
        $this->teacherTemplate('video.add', __('Add Video'), [
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
            'video' => 'mimes:mp4',
            'Poster' => 'image|mimes:jpg,jpeg,png',
            'section' => ['required', 'exists:sections,id']
        ]);
        $path_video = null;
        if ($request->hasFile('video') && $request->File('video')->isValid()) {
            $file = $request->file('video');
            $path_video = $file->store('videos', 'uploads');
        }
        $path_Poster = null;
        if ($request->hasFile('Poster') && $request->File('Poster')->isValid()) {
            $file = $request->file('Poster');
            $path_Poster = $file->store('img', 'uploads');
        }
        $video = new Video;
        $video->video = $path_video;
        $video->Poster = $path_Poster;
        $video->section_id = $request->post('section');
        if (!$video->save()) {
            if ($path_Poster != null) {
                Storage::disk('uploads')->delete($path_Poster);
            }
            if ($path_video != null) {
                Storage::disk('uploads')->delete($path_video);
            }
            return redirect()->route('teacher.video.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('teacher.video.index')->with('Success', __('Add success'));
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
        $video = Video::find($id);

        if ($video == null) {
            return redirect()->route('teacher.video.index')->with('Error', __('Not Fond') . ' ' . __('video'));
        } else {
            $section_video = $video->section()->pluck('id')->toArray();
            $sections = Section::all();
            $this->teacherTemplate('video.edit', __('Edit Video'), [
                'video' => $video,
                'sections' => $sections,
                'section_video' => $section_video,
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
            'vidoe' => 'mimes:mp4',
            'section' => ['required', 'exists:sections,id']
        ]);
        $video = Video::find($id);
        $path_video = $video->video;
        $old_path_video = $video->video;
        if ($request->hasFile('video') && $request->File('video')->isValid()) {
            $file = $request->file('video');
            $path_video = $file->store('videos', 'uploads');
        }
        $path_Poster = $video->Poster;
        $old_path_Poster = $video->Poster;
        if ($request->hasFile('Poster') && $request->File('Poster')->isValid()) {
            $file = $request->file('Poster');
            $path_Poster = $file->store('img', 'uploads');
        }
        $video->video = $path_video;
        $video->Poster = $path_Poster;
        $video->section_id = $request->post('section');
        if (!$video->save()) {
            if ($path_video != $old_path_video) {
                Storage::disk('uploads')->delete($path_video);
            }
            if ($path_Poster != $old_path_Poster) {
                Storage::disk('uploads')->delete($path_Poster);
            }
            return redirect()->route('teacher.video.index')->with('Error', __('an error occurred'));
        }
        if ($old_path_video && $old_path_video != $path_video) {
            Storage::disk('uploads')->delete($old_path_video);
        }
        if ($old_path_Poster && $old_path_Poster != $path_Poster) {
            Storage::disk('uploads')->delete($old_path_Poster);
        }
        return redirect()->route('teacher.video.index')->with('Success', __('Edit success'));
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
        $video = Video::find($id);
        if ($video == null) {
            return redirect()->route('teacher.video.index')->with('Error', __('Not Fond') . ' ' . __('video'));
        }
        $video->delete();
        Storage::disk('uploads')->delete($video->video);
        Storage::disk('uploads')->delete($video->Poster);
        return redirect()->route('teacher.video.index')->with('Success', __('delete success'));
    }
}
