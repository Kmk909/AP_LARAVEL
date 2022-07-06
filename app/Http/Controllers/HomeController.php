<?php

namespace App\Http\Controllers;

use index;
use App\Models\Post;
use App\Models\User;
use App\Mail\PostStored;
use App\Models\Category;
use App\Mail\PostCreated;
use Illuminate\Http\Request;
use App\Events\PostCreatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCreatedNotification;


class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function testroot()
    //{
      //  dd('This is the root path');
    //}
    public function index()
    {
        //$data=Post::all();
        // $user=User::find(1);
        // $user->notify(new PostCreatedNotification());
        //Notification::send(User::find(1),new PostCreatedNotification());
        //echo 'noti sent.';exit();
        $data=Post::where('user_id',auth()->id())->orderBy('id','desc')->get();
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
    public function store(StorePostRequest $request)
    {
        $validated=$request->validated();
        $post=Post::create($validated + ['user_id'=>Auth::user()->id]);
        //$post = new Post();
        //$post->name = $request->name;
        //$post->description = $request->description;

        //$post->save();
        //Post::create([
          //  'name' => $request->name,
            //'description'=>$request->description,
            //'category_id'=>$request->category,
        //]);
        event(new PostCreatedEvent($post));
        return redirect('posts')->with('status', config('aprogrammer.message.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        
        //$post = POST::findOrFail($id);
        //dd($post->categories);
        //if($post->user_id != auth()->id()){
          //  abort(403);

        //};
        $this->authorize('view', $post);
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
        //$post=POST::findOrFail($id);
        //if($post->user_id != auth()->id()){
          //  abort(403);

        //};
        $this->authorize('view', $post);
        $categories=Category::all();
        return view('edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $validated=$request->validated();
        $post->update($validated);
        //$post=POST::findOrFail($id);
        
       // $post->name=$request->name;
        //$post->description=$request->description;

        //$post->save();
        //$post->update([
          //  'name' => $request->name,
            //'description'=>$request->description,
            //'category_id'=>$request->category_id,
        //]);
        return redirect('posts')->with('status', config('aprogrammer.message.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('posts')->with('status',config('aprogrammer.message.deleted'));
    }
}
