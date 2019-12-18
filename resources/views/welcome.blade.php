<?php use App\Post;
      use App\User; ?>

@extends('layouts.main')

@section('title', '- Home')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="jumbotron">
      <h1>Fakebook!</h1>
      <p class="lead">Welcome to the Fakebook multi-user blog, enjoy the posts!</p>
      <p><a class="btn btn-primary btn-lg" href="{{ route('posts.index') }}" role="button">View All Posts</a></p>
    </div>
  </div>
</div>
  <div class="row">
    <div class="col-md-8">
      
      <div class="post">
        <h2>Random Post</h2>
        <?php $post = Post::get()->random(); ?>
        <h3>{{ $post->title }} <small>by <a href="users/{{User::find($post->user_id)->id}}">{{User::find($post->user_id)->username}}</a></small></h3>
        <p>{{ substr($post->content, 0, 200) }}...</p>
        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
      </div>
      <hr>
    </div>
  </div>
</div>
@endsection