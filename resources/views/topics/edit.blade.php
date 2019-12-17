@extends('layouts.main')

@section('title', '- Edit Topic')

@section('content')

{{ Form::model($topic, ['route' => ['topics.update', $topic->id], 
    'method' => 'PUT']) }}

    {{ Form::label('name', 'Title:') }}
    {{ Form::text('name', null, ['class'=>'form-control']) }}

    {{ Form::submit('Save Changes', ['class' => 'btn btn-success', 
        'style' => 'margin-top: 20px;']) }}

{{ Form::close() }}

@endsection