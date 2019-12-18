<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Topic;
use App\Comment;
use Auth;
use Image;
use Storage;
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
        // Most recent posts appear at the top, 10 per page
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

        // Checks if a file has been attached and saves it if so
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $post->id . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/' . $fileName);
            Image::make($image)->resize(500, 400)->save($location);
            $post->image = $fileName;
        }

        $post->save();

        // Attach topics after post has been saved
        $post->topics()->sync($request->topics, false);

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
        $post = Post::findOrFail($id);
        $topics = Topic::pluck('name','id')->all();
        return view('posts.edit', ['post' => $post, 'topics'=>$topics]);
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

        // Checks if a file has been attached
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $post->id . '.' . $image->getClientOriginalExtension();
            $location = public_path('img/' . $fileName);
            Image::make($image)->resize(500, 400)->save($location);
            $oldFileName = $post->image;
            $post->image = $fileName;
            Storage::delete($oldFileName);
        }

        $post->save();

        $post->topics()->sync($request->topics, true);

        //dd($post->topics);
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
        $post->topics()->detach(); // Removing associated topics; topics can't be linked to non-existent posts
        Storage::delete($post->image);
        $post->delete();

        Session::flash('success', 'Post Deleted!');

        return redirect()->route('posts.index');
    }

    public function comment(Request $request, $post_id) {
        $this->validate($request, [
            'content' => 'required'
        ]);
        $post = Post::findOrFail($post_id);

        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        Session::flash('success', 'Comment added!');
        return redirect()->route('posts.show', $post->id);
    }
}
