<!--
Template Inheritance:
There are blades that have exact common parts.
(index and show) views have an exactly same part, so it's put here
In documentation, its path is: resources/views/layouts/app.blade.php
-->

<!-- 
Three steps to achieve this:
1- app.blade.php ely hatena feh el common part
2- Hna: yield('content'): 3shan y3rf en fel makan da hyhot el mokhtlf ely fe kol blade
3- In the blades: extends('layouts.app') + section('content')
   + endsection: 3shan y3rf en hoa da el goz2
-->
 
<!-- This is the exact common part in both views(blades):- -->

<!-- /////////////////// da the upper part /////////////////////////////// -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- 3yza el title 3la hasab el page ely ehna feeha -->
    <title>  @yield('title') </title>
  </head>
  <body>
    <div class="container mt-5">

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light my-5">
      <div class="container-fluid d-flex justify-content-center">
          <a class="navbar-brand" href="{{route('posts.index')}}">All Posts</a>
      </div>
    </nav>

    @yield('content')

    <!-- /////////////////// w da the lower part /////////////////////////////// -->

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>