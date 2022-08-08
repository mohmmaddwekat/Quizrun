<?php

namespace App\Http\Controllers\Student;

use App\Models\Teacher\Group;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index() {
        $groups =[];
        $this->StudentTemplate('search',__('Search'),['groups'=>$groups]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:255'],
            'order' => 'required|in:description,name',
            'sort' => 'required|in:ASC,DESC',
        ]);
        $groups = Group::where($request->order, 'like', '%'.$request->message.'%')->orderBy($request->order, $request->sort)->get();
        $this->StudentTemplate('search',__('Search'),['groups'=>$groups]);
    }
}
