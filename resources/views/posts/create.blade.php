@extends('layouts.app')  

@section('title') Create New Post @endsection

@section('content')

<!-- Displaying the Validation Errors on the requests -->
<!-- This part is taken gahez mn el documentation -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="{{route('posts.store')}}">
    <!-- Lazm fe ay form, aktb this csrf to guarantee preventing csrf attacks  -->
    @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <!-- el value old de 3shan lw dkhal invalid input, el last wrong input yfdl zaher -->
    <input name="title" type="text" class="form-control" id="title" value="{{old('title')}}">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="description" class="form-control" id="description">{{old('description')}}</textarea>
  </div>
  <h4>..... is posting</h4>
  <!-- The users' dropdown menu -->
  <div class="mb-3">
    <select class="form-control" name="post_creator">
      @foreach($allUsers as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
    </select>
  </div>

  <button type="submit" class="btn btn-success">Share Post</button>
</form>

@endsection