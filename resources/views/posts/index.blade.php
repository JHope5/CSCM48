<?php use App\User; use App\Comment; ?>

@extends('layouts.main')

@section('title', '- Posts')

@section('content')

    <div class="row">
        <div class="col-md-9">
            <h1>All Posts</h1>
        </div>
        <div class="col-md-3">
        <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary">Create New Post</a>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    
    <div class="pagination">
            {!! $posts->links(); !!}
        </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Posted By</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Comments</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <th>{{$post->id}}</th>
                            <th>{{ User::find($post->user_id)->username }} </th>
                            <td>{{$post->title}}</td>
                            <td>{{substr($post->content, 0, 50)}} <br> {{ strlen($post->content) > 50 ? Html::linkRoute('posts.show', 'Read More...', array($post->id)) : "" }}</td>
                            <td>{{ date('jS M, Y H:i', strtotime($post->created_at)) }}</td>
                            <td>{{ Comment::get()->where('post_id', $post->id)->count() }}</td>
                            <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a>
                                @if((Auth::id() == $post->user_id) || (Auth::id() == 1))
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a>
                                @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {!! $posts->links(); !!}
            </div>
        </div>
    </div>

@endsection