@extends('layouts.app')        

@section('title') Index @endsection

@section('content')

        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ route('posts.create') }}" class="btn btn-dark my-3 p-3">Create Post</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($returnedPosts as $one_post)
                    <!-- To execute dd line, put abl dd el @ bs lw 3mltha
                         w sebtha in comment el app bydrb m3rfsh leeh -->
                    <!-- Htla2y en $returnedPosts is of type Collection object
                         w el object msh bn2dr n-for loop 3leeh, bs hna we could
                         3shan LARAVEL implements (MAGIC METHODS) -->
                    <!-- dd($returnedPosts); -->
                    <!-- Type of $one_post is: OBJECT -->
                    <!--  -->
                    <!-- To execute dd line, put abl dd el @ bs lw 3mltha
                         w sebtha in comment el app bydrb m3rfsh leeh -->
                    <!-- dd($one_post); -->
                    
                    <!-- Object is accessed by ( -> ) not ( [] )-->
                    <!-- Some magic how, laravel allows both ways bcz of Magic Methods -->
                    <!-- So, {{$one_post->id}} and {{$one_post['id']}} are both correct.  -->
                    <tr>
                        <th scope="row">{{ $one_post->id }}</th>
                        <td>{{ $one_post['title'] }}</td>

                        <!-- /////////////////// POSTED BYYYYY //////////////////// -->
                         
                        <!-- Try this dd() (eb2i hotty @ bs before dd line 33), the 
                        first shows a User Objecttt, while the second returns
                        a (BelongsTo) object -->
                        <!-- dd($one_post->user, $one_post->user()) -->

                        <!--Msh 3yzeen el id-->
                        <!-- <td>{{ $one_post->user_id }}</td> -->

                        <!-- Msh 3yzeen kol data el user, we just want the name -->
                        <!-- <td>{{ $one_post->user }}</td> -->


                        <!-- This will hit an error since feh posts 3ndhom
                        el user_id b nulls, it can't find a (null) id!! -->
                        <!--{{-- <td>{{ $one_post->user->name }}</td> --}}-->

                        <!-- Soooo, -->
                        <td>{{ $one_post->user ? $one_post->user->name : 'User not found' }}</td>


                        <!-- /////////////////// END POSTED BYYYYY //////////////////// -->

                        <td>{{ $one_post->created_at->format('Y-m-d') }}</td>
                        <td>
                            <!-- We want when click View button, show details of this post. -->
                            <!-- So, in href, put the ROUTE of this functionality from web.php -->
                            <!-- <a href="/posts/{{ $one_post->id }}" class="btn btn-info m-1">View</a> -->
                            <!-- ORRR (Using Routing name:) -->
                            <!-- <a href="{{route('posts.show', $one_post->id )}}" class="btn btn-info m-1">View</a> -->
                            <!-- ORRR ,,,,  'post' is the param name in route in web.php          -->
                            <a href="{{route('posts.show', ['post' => $one_post->id] )}}" class="btn btn-info m-1">View</a>
                            <!-- In passing the parameter's value, you can do:
                             ...., ['post' => $one_post->id]
                             OR: ....., $one_post['id']  (as shown below):-
                            -->
                            <!-- OR: <a href="{{route('posts.show', $one_post['id'] )}}" class="btn btn-info m-1">View</a> -->
                            
                            <a href="{{route('posts.edit', ['post' => $one_post->id] )}}" class="btn btn-primary m-1">Edit</a>
                            <!-- hnkhaly el Delete da button msh anchor w since it's a button, it
                            needs to be within a form
                            NEVER forget: when route in web.php needs a parameter, it has to be
                            passedddd fel actionnnn aw el anchorrrr. -->
                            <form style="display:inline;" method="POST" action="{{route('posts.destroy', ['post' => $one_post->id] )}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger m-1" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
@endsection
    