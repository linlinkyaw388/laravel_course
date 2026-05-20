<?php

namespace App\Http\Controllers;

use App\Http\Requests\storePostRequest;
use App\Mail\PostCreated;
use App\Mail\PostStored;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Mockery\Matcher\Not;

class HomeController extends Controller
{
    //auth ကို controller ထဲပြောင်းလို့ရတယ်။
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mail::raw('Hello from Laravel!', function ($message) {
        //     $message->to('example@example.com', 'Example')->subject('Hello from Laravel!');
        // }); 

        //Notification 1    facade
        // Notification::send(User::find(1),new PostCreatedNotification());
        // echo 'noti send';exit();
        //Notification 2
        // $user = User::find(1);
        // $user->notify(new PostCreatedNotification());

        //                      //auth()->user()->id
        $data = Post::where('user_id',auth()->id())->orderBy('id','desc')->get();
        return view('home',compact('data'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create($validated + ['user_id' => Auth::user()->id]);

        // Mail::to('hlaing@gmail.com')->send(new PostStored($post));
        Mail::to('hlaing@gmail.com')->send(new PostCreated());

        return redirect('/posts')->with('status',config('aprogrammer.message.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // if(auth()->id() != $post->user_id){      //customized auth
        //     abort(403);
        // }
        $this->authorize('view',$post);
        return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // if(auth()->id() != $post->user_id){
        //     abort(403);
        // }

        $this->authorize('update',$post);

        $categories = Category::all();
        return view('edit',compact('post','categories'));;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Post::findorFail($id)->delete();
        // $post = Post::findorFail($id);
        $post->delete();
        return redirect('/posts');
    }
}
