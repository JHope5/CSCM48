@extends('layouts.main')

@section('title', '- Create Post')

@section('stylesheets')

    {!! Html::style('css/select2.min.css') !!}

@endsection

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card"> 
                    <div class="card-header">{{ __('Create Post') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf
    
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Post Title') }}</label>
    
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
    
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
     
                                <div class="col-md-6">
                                    <textarea id="content" type="text" class="form-control" name="content" value="{{ old('content') }}" required autocomplete="current-content" style="width: 320px; height: 400px;"></textarea>
    
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="topics" class="col-md-4 col-form-label text-md-right">{{ __('Topics') }}</label>
        
                                <div class="col-md-6">
                                    <select class="form-control select2" name="topics[]"
                                        multiple="multiple">
                                     @foreach ($topics as $topic)
                                            <option value="{{ $topic->id }}">{{ $topic->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group-row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">{{__('Attach Image')}}</label>
                                <div class="col-md-6">
                                    <input type="file" id="image" name="image" class="form-control" accept="image/png, image/jpeg">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary" style="margin-top:10px;">
                                            {{ __('Submit Post') }}
                                        </button>
                                        <a href="{{ route('posts.index') }}">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('scripts')

    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
        $('.select2').select2();
    </script>

@endsection