<?php use App\Post;
      use App\Comment; ?>

@extends('layouts.main')

@section('title', '- Users')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>All Users</h1>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Username</th>
                    <th>Posts</th>
                    <th>Comments</th>
                    <th>Joined</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <th>{{ $user->username }} </th>
                            <td>{{ Post::get()->where('user_id', $user->id)->count() }}</td>
                            <td>{{ Comment::get()->where('user_id', $user->id)->count() }}</td>
                            <td>{{$user->created_at}}</td>
                            <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-default btn-sm">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection