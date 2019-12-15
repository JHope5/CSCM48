@extends('layouts.main')

@section('title', '- Contact Us')

@section('content')
<div class="row">
  <div class="col-md-12">
    <h1>Report an Issue</h1>
    <h2>(or make a suggestion!)</h2>
    <br>
    <form>
      <div class="form-group">
        <label name="email">Your Email (if you'd like a response from us):</label>
        <input id="email" name="email" class="form-control">
      </div>
      <div class="form-group">
        <label name="postID">If you are concerned about any posts, enter their IDs:</label>
        <input id="postID" name="postID" class="form-control">
      </div>
      <div class="form-group">
        <label name="content">Your message:</label>
        <input id="content" name="content" class="form-control">
      </div>
      <input type="submit" value="Submit" class="btn btn-success">
    </form>
  </div>
</div>
@endsection