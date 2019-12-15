@extends('layouts.main')

@section('title', '- Users')

@section('content')
<br>
<div class="row">
  <div class="col-md-12">
    <h1>Fakebook Users</h1>
    <br>
    <ul>
      @foreach ($users as $user)
        <li><a href="{{ route('users.show', ['id'=>$user->id]) }}">{{ $user->username }}</a></li>
      @endforeach
    </ul>
  </div>
</div>
@endsection