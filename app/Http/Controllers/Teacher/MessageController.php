<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Forum;
use App\Models\Message;
use App\Models\Teacher\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id forum_id 
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $messages = Message::orderBy('created_at')->where('forum_id', $id)->get();
        $forum = Forum::find($id);
        $this->teacherTemplate('message.index', __('Forum'), ['messages' => $messages, 'forum' => $forum]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id forum_id 
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $message = Message::with(['user', 'teacher'])->where('forum_id', $id)->orderBy('created_at')->get();
        return $message;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id forum_id 
     * @param  string  $message
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id, $messages)
    {
        //
        $message = new Message;
        $message->message = $messages;
        $message->teacher_id = Auth::guard('teacher')->user()->id;
        $message->forum_id = $id;
        $message->save();
        return $message;
    }
}
