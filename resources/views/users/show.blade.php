@extends('layouts.main')

@section('title', '- User Information')

@section('content')
<br>
<div class="row">
  <div class="col-md-12">
    <h1>User #{{$user->id}}</h1>
    <br>
    <ul>
      <li>Username: {{ $user->username }}</li>
      <li>Posts: {{ $post->get->where('user_id', 9)->count}}</li>-->
      
    </ul> 
  </div>
</div>
@endsection