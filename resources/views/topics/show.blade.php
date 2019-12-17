@extends('layouts.main')

@section('title', "- $topic->name Posts")

@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>{{ $topic->name }} Posts <small>Total: {{ $topic->posts()->count() }}</small></h1>
    </div>
    @if(Auth::id() == 1)
    <div class="col-md-2">
        <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-primary pull-right btn-block" style="margin-top:20px;">Edit</a>
    </div>
    <div class="col-md-2">
        {{ Form::open(['route' => ['topics.destroy', $topic->id], 'method' => 'DELETE']) }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'style' => 'margin-top:20px;']) }}
        {{ Form::close() }}
    @endif
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Topics</th>
                    <th><th>
                </tr>
            </thead>
            <tbody>
                @foreach($topic->posts as $post)
                <tr>
                    <th>{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->content}}</td>
                    <td>@foreach($post->topics as $topic)
                        {{ $topic->name }}
                        @endforeach
                    </td>
                    <td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection