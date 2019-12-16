<?php use App\User; ?>

@extends('layouts.main')

@section('title', '- Edit Post')

@section('content')

<div class="row">
    <div class="col-md-8">

        <!-- Helped with Laravel Collective
                https://laravelcollective.com/docs/6.0/html -->
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
        <div class="col-md-8">
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}
            <br>
            {{ Form::label('content', "Content:") }}
            {{ Form::textarea('content', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Post Information - #{{$post->id}}</div>
                    <div class="card-body">
                      <dl class="row">
                          <dt class="col-sm-6">Posted By</dt>
                          <dd class="col-sm-6"><a href="../users/{{$post->user_id}}">{{ User::find($post->user_id)->username }}</a></dd>
                      </dl>
                      <dl class="row">
                          <dt class="col-sm-6">Created At</dt>
                          <dd class="col-sm-6">{{ date('F jS, Y H:i', strtotime($post->created_at)) }}</dd>
                      </dl>
                      <dl class="row">
                            <dt class="col-sm-6">Last Updated</dt>
                            <dd class="col-sm-6">{{ date('F jS, Y H:i', strtotime($post->updated_at)) }}</dd>
                        </dl>
                      <hr>
                      <div class="row">
                          <div class="col-sm-7">
                              {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                          </div>
                          <div class="col-sm-5">
                              {!! Html::linkRoute('posts.edit', 'Cancel', array($post->id), array('class' =>'btn btn-danger btn-block')) !!}
                          </div>
                          </div>
                      </div>
                    </div>
                  </div>
    </div>
</div>

@endsection