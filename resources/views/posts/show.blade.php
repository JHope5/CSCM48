<?php use App\User; use App\Comment; ?>

@extends('layouts.main')

@section('title', '- View Post')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>{{ $post->title }}</h1> 
        <p class="lead">{{ $post->content }}</p>
        @if(!$post->image == null)
        <img src="{{ asset('img/' . $post->image) }}">
        @endif
        <hr>
    </div>
    <div class="col-md-4">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">Post Information - #{{$post->id}}</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-5">Posted By</dt>
                        <dd class="col-sm-7"><a href="../users/{{$post->user_id}}">{{ User::find($post->user_id)->username }}</a></dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-5">Created At</dt>
                        <dd class="col-sm-7">{{ date('F jS, Y H:i', strtotime($post->created_at)) }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-5">Last Updated</dt>
                        <dd class="col-sm-7">{{ date('F jS, Y H:i', strtotime($post->updated_at)) }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-5">Topics</dt>
                        <dd class="col-sm-7">
                            @foreach($post->topics as $topic)
                            {{ $topic->name }}; 
                            @endforeach
                        </dd>
                    </dl>
                        
                    @if((Auth::id() == $post->user_id) || (Auth::id() == 1))
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-primary btn-block')) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            {!! Html::linkRoute('posts.index', '<< View All Posts', null, array('class'=>'btn btn-secondary btn-block')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <h4>Comments</h4>
        <hr>
        <div style="margin-bottom: 50px;">
            
            <div id="comment-form">
                <div class="col-md-6">
                    <form method="POST" action='{{ url("/comment/{$post->id}") }}'>
                        @csrf
                        <textarea id="content" rows="3" class="form-control" 
                            name="content" placeholder="Have your say!"
                            required autofocus></textarea>
                        <button type="submit" class="btn btn-success"
                            style="margin-top:10px;">Post Comment</button>
                    </form>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>Posted By</th>
                <th>Comment</th>
                <th>Created At</th>
                <th>Last Updated</th>
                <th></th>
            </thead>

            <tbody>
                <?php $comments = Comment::get()->where('post_id', $post->id); ?>
                @foreach($comments as $comment)
                    <tr>
                        <th><a href="../users/{{$comment->user_id}}">{{ User::find($comment->user_id)->username }} </th>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>{{ $comment->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection