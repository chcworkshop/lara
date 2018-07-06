<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Log;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        Log::info($posts);
        return view('posts.index',compact('posts')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->fill($request->all());
        $post->user_id = auth()->user()->id;

        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        //return response()->json($post);
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {
        //
        //return view('posts.edit');
        return $post_id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, PostRequest $request)
    {
        //$validated = $request->validated();
        ///Log::info($request);
        $post = Post::find($id);

        $user = auth()->user();
        if ($user->can('update',$post)) {
            $post->title = $request->title;
            $post->category = $request->category;
            $post->content = $request->content;
            $post->save();

            return redirect()->route('posts.index');
        }else {
            $err_delete = '無權限編輯!';
            $posts = Post::all();
            return view('posts.index',compact('posts','err_delete'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info("delete:" . $id);
        $post = Post::find($id);
        if ($post->user_id === auth()->user()->id) {
            Post::find($id)->forceDelete();
            
            return redirect()->route('posts.index');
        }else {
            $err_delete = '無權限刪除!';
            $posts = Post::all();
            return view('posts.index',compact('posts','err_delete'));
        }
    }
}
