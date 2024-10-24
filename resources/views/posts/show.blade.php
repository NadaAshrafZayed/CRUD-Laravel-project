@extends('layouts.app')        

@section('title') Show @endsection

@section('content')

        <div class="card">
            <h2 class="card-header">
                Post Info
            </h2>
            <div class="card-body">
                <h4 class="card-title"> <b>ID:</b> {{ $singlePost->id }}</h4>
                <hr>
                <h5 class="card-title"> <b>Title:</b> {{ $singlePost->title }}</h5>
                <hr>
                <h5 class="card-title"> <b>Description:</b> {{ $singlePost->description }}</h5>
                <hr>
                <p class="card-text"> <b>Created at:</b> {{ $singlePost->created_at->format('Y-m-d') }} </p>
                <p class="card-text"> <b>updated at:</b> {{ $singlePost->updated_at }} </p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
@endsection