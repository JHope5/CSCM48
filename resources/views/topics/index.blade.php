@extends('layouts.main')

@section('title', '- Topics')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Topics</h1>
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
                    <th>Name</th>
                </thead>

                <tbody>
                    @foreach($topics as $topic)
                        <tr>
                            <th>{{$topic->id}}</th>
                            <th><a href="{{ route('topics.show', $topic->id) }}">{{ $topic->name }}</a>; </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <div class="well">
                {!! Form::open(['route' => 'topics.store', 'method' => 'POST']) !!}
                <h2>New Topic</h2>
                {{ Form:: label('name', 'Name:') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
                {{ Form::submit('Create New Topic', ['class' => 'btn btn-primary 
                    btn-block']) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection