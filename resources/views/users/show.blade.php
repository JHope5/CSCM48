<?php use App\Post;
      use App\Comment; use App\User; ?>

@extends('layouts.main')

@section('title', '- User Information')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>{{ $user->username }}</h1>
        <hr>
        <h3>Posts</h3>
        <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Comments</th>
                    <th></th>
                </thead>

                <tbody>
                    <?php $posts = Post::get()->where('user_id', $user->id); ?>
                    @foreach($posts as $post)
                        <tr>
                            <th>{{$post->id}}</th>
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
            <hr>
            <h3>Comments</h3>
            <table class="table">
                    <thead>
                        <th>Post ID</th>
                        <th>Posted By</th>
                        <th>Post Title</th>
                        <th>Comment</th>
                        <th>Created At</th>
                        <th></th>
                    </thead>
    
                    <tbody>
                        <?php $comments = Comment::get()->where('user_id', $user->id); ?>
                        @foreach($comments as $comment)
                            <tr>
                                <th>{{ Post::find($comment->post_id)->id }}</th>
                                <th>{{ User::find(Post::find($comment->post_id)->user_id)->username }} </th>
                                <td>{{ Post::find($comment->post_id)->title}}</td>
                                <td>{{substr(Post::find($comment->post_id)->content, 0, 50) }}</td>
                                <td>{{ date('jS M, Y H:i', strtotime($comment->created_at)) }}</td>
                                <td><a href="{{ route('posts.show', Post::find($comment->post_id)->id) }}" class="btn btn-default btn-sm">View</a>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
    
    <div class="col-md-4">
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">User Information</div>
                    <div class="card-body">
                      <dl class="row">
                          <dt class="col-sm-6">User ID</dt>
                          <dd class="col-sm-6">{{ $user->id }}</a></dd>
                      </dl>
                      <dl class="row">
                          <dt class="col-sm-6">Posts</dt>
                          <dd class="col-sm-6">{{ Post::get()->where('user_id', $user->id)->count() }}</a></dd>
                      </dl>
                      <dl class="row">
                          <dt class="col-sm-6">Comments</dt>
                          <dd class="col-sm-6">{{ Comment::get()->where('user_id', $user->id)->count() }}</a></dd>
                      </dl>
                      <dl class="row">
                          <dt class="col-sm-6">Profile Views</dt>
                          <dd class="col-sm-6"># of views</a></dd>
                      </dl>
                      @if((Auth::id() == $user->id) || (Auth::id() == 1))
                      <hr>
                      <div class="row">
                          <div class="col-sm-12">
                              {!! Html::linkRoute('users.destroy', 'Delete User', array($user->id), array('class' =>'btn btn-danger btn-block')) !!}
                          </div>
                          </div>
                      </div>
                      @endif
                    </div>
                  </div>
    </div>
</div>
@endsection