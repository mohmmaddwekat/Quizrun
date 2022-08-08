<?php

namespace App\Http\Controllers\Student;

use App\Models\Forum;
use App\Models\Message;
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
        $this->StudentTemplate('message.index', __('Forum'), ['messages' => $messages, 'forum' => $forum]);
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
        $message->user_id = Auth::guard('student')->user()->id;
        $message->forum_id = $id;
        $message->save();
        return $message;
    }
}
