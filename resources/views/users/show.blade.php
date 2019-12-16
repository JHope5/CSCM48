<?php use App\Post;
      use App\Comment; ?>

@extends('layouts.main')

@section('title', '- User Information')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>{{ $user->username }}</h1>
        <!-- SHOW POSTS HERE -->
        <!-- SHOW COMMENTS HERE -->
        <hr>
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
                      <hr>
                      <div class="row">
                          <div class="col-sm-12">
                              {!! Html::linkRoute('users.destroy', 'Delete User', array($user->id), array('class' =>'btn btn-danger btn-block')) !!}
                          </div>
                          </div>
                      </div>
                    </div>
                  </div>
    </div>
</div>
@endsection