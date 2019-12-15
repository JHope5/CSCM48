@extends('layouts.main')

@section('title', '- View Post')

@section('content')

<div class="row">
    <div class="col-md-8">
        <h1>{{ $post->title }}</h1>

        <p class="lead">{{ $post->content }}</p>
    </div>
    <div class="col-md-4">
            <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Post Information</div>
                    <div class="card-body">
                      <dl class="row">
                          <dt class="col-sm-6">Posted By:</dt>
                          <dd class="col-sm-6">User?!?!?!?!</dd>
                      </dl>
                      <dl class="row">
                          <dt class="col-sm-6">Created At:</dt>
                          <dd class="col-sm-6">{{ date('F jS, Y H:i', strtotime($post->created_at)) }}</dd>
                      </dl>
                      <dl class="row">
                            <dt class="col-sm-6">Last Updated:</dt>
                            <dd class="col-sm-6">{{ date('F jS, Y H:i', strtotime($post->updated_at)) }}</dd>
                        </dl>
                      <hr>
                      <div class="row">
                          <div class="col-sm-6">
                              {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-primary btn-block'))!!}
                          </div>
                          <div class="col-sm-6">
                              {!! Html::linkRoute('posts.destroy', 'Delete', array($post->id), array('class' =>'btn btn-danger btn-block')) !!}
                          </div>
                          </div>
                      </div>
                    </div>
                  </div>
    </div>
</div>

@endsection