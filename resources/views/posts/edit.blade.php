@extends('layouts.app')   

@section('title') Edit some post @endsection

@section('content')

<!-- 
Method here is PUT but the browser does not support PUT/DELETE in Form submission
but it supports them in Ajax requests only.
So, we make method="POST" w goa bn-use method('PUT')
-->
<!--                 since el routing name da htla2eeh needs a parameter(el id)  -->
<!--                                          OR: , $post->id          -->
<form method="POST" action="{{route('posts.update', ['post' => $post->id])}}">
  @csrf
  @method('PUT') <!--Now method is PUT-->
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input name="title" type="text" class="form-control" id="title" value="{{ $post->title }}">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control" id="description">
{{ $post->description }}
    </textarea>
  </div>

  <!-- The users' dropdown menu -->
  <div class="mb-3">
    <select class="form-control" name="user_id">
      @foreach($users as $user)
      <!-- We want here to show in the selection bar the user who shared this post -->
        <option value="{{$user->id}}" @if($user->id == $post->user_id) selected  @endif>{{$user->name}}</option>
      @endforeach
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Edit Post</button>
</form>

@endsection