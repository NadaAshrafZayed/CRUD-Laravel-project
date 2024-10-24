<?php

// namespace: bktb el path of folder ll current file da (PostController)
namespace App\Http\Controllers;

// use: bktb paths el files I'll use here
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){
        // Using the Post model, return data of posts table from database
        $postsFromDB = Post::all();
        // dd de function bt-show type and details of the argument sent to it.
        // This is Dump and Die so execution stops
        // dd($postsFromDB);
        // 3yzeen nrg3 el array da baa ll index blade view 3shan n3rf n-use it there
        return view('posts.index', ['returnedPosts' => $postsFromDB]);
    }

    public function show($post_id){

        $specific_post = Post::findOrFail($post_id);
        return view('posts.show', ['singlePost' => $specific_post]);
        
        ///////////////////////////////////////////////////////////////////////

        // Another way: find and check

        // $specific_post = Post::find($post_id);
        // if($specific_post){
        //     return view('posts.show', ['singlePost' => $specific_post]);
        // }else{
        //     return 'This post is not existed.';
        // }

        ///////////////////////////////////////////////////////////////////////

        // Another way: where

        // $specific_post = Post::where('id', $post_id)->first();
        /*
        in dd line: mn gher el ( ->first() ) => el type: Eloquent Builder 3shan where()
        Lw b ( ->first() ) => el type: Model Object 3adyy (Post)
        Lw ( ->get() ) => el type: Collection Object (goah record wahed bs)
        */
        // // dd($specific_post); 

        /*
        TRY:
        
        */
        // dd(
        //     Post::where('title', 'Story')->first(); // select * from posts where title='Story' LIMIT 1;
        //     // Post::where('title', 'Story')->get(); // select * from posts where title='Story';
        // );


        // return view('show', ['singlePost' => $specific_post]);
    }

    /*
    CONTINUE: There is another way to do the same functionality findOrFail()
    in show() method.
    This is called Route Model Binding:
    1- Since: Route::get('/posts/{post}', [PostController::cla........, so
    the parameter passed here should be $post as in the Route parameter {post}.
    2- Type hint the variable => Make its type: Post, the Model.
    3- Sheely khalas satr el findOrFail()
    */
    // public function show(Post $post){ // Type hinting
    //     dd($post);
    //     return view('posts.show', ['singlePost' => $post]);
    // }


    public function create(){
        /*
        At the end khales, he wanted to add a dropdown menu of users in db
        as which user is sharing this post. So retrieve them all from db
        */
        $allUsersExisted = User::all();
        // dd($allUsersExisted);
        //                     bb3thom 3shan 3yza a-show them in create blade
        return view('posts.create', ['allUsers' => $allUsersExisted]);

        // Before the users' dropdown menu:
        // return view('posts.create');
    }


    public function store(Request $request){
        /*
        $request is an Object type. wl object da 3mlholna gahezz haga esmha
        Service Container.
        */
        // dd($request);
        //names returned from the form input fields are: title, description, post_creator
        $postTitle = $request->title;
        $postDescription = $request->description;
        // Posted by this user, so I want to add it with the info to database
        $userId = $request->post_creator;
        // dd($userId);


        /*
        //////////////////////// Request Validation ///////////////////////////////
        This is the right action method to apply the Backe-end validation in.
        Since en de el function ely btwddy el request ll database, fa we need
        to check on it before db. Akiid msh hn-check 3l request fl create() msln, it
        just shows the form.
        https://laravel.com/docs/11.x/validation#available-validation-rules => Here,
        you can see a list of all available validation rules you want to validate on.
        https://laravel.com/docs/11.x/validation#quick-displaying-the-validation-errors
        And here, you can display like messages showing the validation errors.
        */
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'post_creator' => 'required|integer|exists:users,id' // User ID is required,
                                                            // must be an integer,
                                                            // and MUST exist
                                                            // in the 'users' table in
                                                            // the 'id' column.
        ]);



        // Store in database as a new post (Create new record)
        /*
        Here you are (filling) some columns in database table with some data.
        This will give Mass Assignment Exception. To solve it, you MUST
        determine [in the model] which columns are allowed to be filled. => $fillable
        */
        $newPost = Post::create([
            // 'column name' => variable keeping the value u want
            'title' => $postTitle,
            'description' => $postDescription,
            'user_id' => $userId
        ]);
        // dd($newPost);


        // **************************************************************************
        // This is another way to create a new record.( bdl el Post::create([]); )
        // $post = new Post;
        // $post->title = $postTitle;
        // $post->description = $postDescription;
        // $post->save();
        // **************************************************************************

        return to_route('posts.index');
        // OR: return redirect()->route('posts.index');
        // OR: return redirect(route('posts.index'));
        // OR: return redirect('/posts'); // not using the routing name
    }


    /*
    CONTINUEEE>>> This is another way to catch the request coming from the form:
    */
    // public function store(){
    //     // $post = request()->all(); // hyrg3 kol ely mn el form (title, description)
    //     // dd($post);

    //     $postTitle = request()->title;
    //     $postDescription = request()->description;
    //     $userId = request()->user_id;
    //     // dd($postTitle, $postDescription);

    //     $newPost = Post::create([
    //         'title' => $postTitle,
    //         'description' => $postDescription,
    //         'user_id' => $userId
    //     ]);

    //     return redirect()->route('posts.index');
    // }


    public function edit($id){
        //  For the users' dropdown menu, hna brdo zy el create() fo2 
        $users = User::all();

        $specific_post = Post::findOrFail($id);
        //                         bb3thom 3shan 3yza a-show them in edit blade
        return view('posts.edit', ['post' => $specific_post, 'users' => $users]);
    }


    /*
    To update a specific post and save this update in database:
    1- You need to get the id of this post to apply the update on THIS POST
    2- Also, you need to catch the Request that is holding the new data
    So, we pass both arguments + note: since en el $request ana m7dda its type
    (Request) so it does not matter the parameters' orders BUT if the function needs
    msln $post_id and $comment, they have to be passed in the order of the URL route
    */
    public function update($post_id, Request $request){
        $singlePost = Post::findOrFail($post_id);
        // Update
        $singlePost->update([
            'title' => $request->title,
            'description' => $request->description,
            // For the users' dropdown menu:
            'user_id' => $request->user_id
        ]);
        return redirect()->route('posts.index');
        // OR: return to_route('posts.index');
    }

    /*
    To delete a specific post
    */
    public function destroy($id){
        $singlePost = Post::findOrFail($id);
        $singlePost->delete();

        // Another way to delete in a single query:
        // Post::where('id' , $id)->delete();

        // In line 199, Model events will not be dispatched for the deleted models. 
        // This is because the models are never actually retrieved when 
        // executing the delete statement. Da 3eeb el delete statement

        return redirect()->route('posts.index');
    }


}
