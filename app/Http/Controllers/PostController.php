<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Topic;
use Auth;
use Session;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $topics = Topic::all();
        return view('posts.create', ['topics' => $topics]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        // Storing data in database
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->save();

        Session::flash('success', 'Post created!');

        return redirect()->route('posts.show', $post->id);

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
        $post = Post::findOrFail($id);

        return view('posts.show', ['post' => $post]);
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
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
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
        // Validate form data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        // Save changes to database
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        Session::flash('success', 'Post Updated!');

        return redirect()->route('posts.show', $post->id);
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
        $post = Post::findOrFail($id);
        $post->delete();

        Session::flash('success', 'Post Deleted!');

        return redirect()->route('posts.index');
    }
}
