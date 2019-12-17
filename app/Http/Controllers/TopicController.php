<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use Session;

class TopicController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topics = Topic::all();
        return view('topics.index', ['topics' => $topics]);
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
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $topic = new Topic;
        $topic->name = $request->name;
        $topic->save();

        Session::flash('success', 'New Topic Created!');

        return redirect()->route('topics.index');
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
        $topic = Topic::findOrFail($id);
        return view('topics.show', ['topic' => $topic]);
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
        $topic = Topic::findOrFail($id);
        return view('topics.edit', ['topic' => $topic]);
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
        $topic = Topic::findOrFail($id);

        $this->validate($request, ['name' => 'required|max:255']);

        $topic->name = $request->name;
        $topic->save();

        Session::flash('success', 'Topic Saved Successfully');
        return redirect()->route('topics.show', $topic->id);
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
        $topic = Topic::findOrFail($id);
        $topic->posts()->detach();

        $topic->delete();

        Session::flash('success', 'Topic successfully deleted!');

        return redirect()->route('topics.index');
    }
}
