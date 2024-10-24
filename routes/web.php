<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// [1]
Route::get('/', function () {
    return view('welcome');
});

// [2]
// hna we followed the Resource Controllers (Read from documentation)
// (To use expressive methods' and controllers' names)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


// [3]
// Now we want when press View button, show the details of this post in another page
/*
Steps:
1- Define a new route
2- Define a new action
3- Query DB & return view
*/


// [5]
// When click Create Post, we want to go to a page containing a form to create the post
/*
NOTE VIP: lw el route da 3mlto b3ddd el route ely taht(bta3 show) and I clicked the
Create post button we wddetny 3la el path da in browser URL, it will think that 
/posts/create is the route /posts/{post}=> so hydkhol in case of Show route
since eno bymshy fel web.php in order and finds the route path that matches
the browser url so take care mn haga zy kda 
*/
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');


// [4]
/*
In Resource Controllers(from documentation), el gadwal da feeh column esmo
Routing name, da byshhl 3lya en msln bdl ma aktb el path kol shwya fe ay
makan 3yza a-use it, mmkn a-use the routing name ashal kteer 3n el url path
(>> msln in index view, when press View button, shofy el href b3tnalha eh)
*/
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');




// [6]
/*
We want to add a post (Fill form of post's data and add to the database)
1- Submit the form to a URL
2- Store the data in database
3- Make a redirection to (/posts)
*/
// According to the Resource controllers, de tree2t tsmyt el route el as7
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');


// [7]
/*
Edit the post by clicking Edit button beside any specific post
*/
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

// [8]
/*
Make the Update to the post you want
*/
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

// [9]
/*
Delete a post
*/
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');