<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {

        $this->middleware('apiJwt');
    }

    public function index(Request $request,Post $post)
    {
        $post = Post::query()->with('user')
        ->get();
        return PostResource::collection($post);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Post $post,User $user)
    {
        $request->user->post()->create([
            "texts" => $request->get('texts'),
        ]
        );
        return "Sucess Create Post";

    }

    /**
     * Display the specified resource.
     *
     * @ param  \App\Models\Post  $post
     * @ return \Illuminate\Http\Response
     */
    //public function show(Post $post)
    public function show(User $user,Post $post)
    {
        return $post->user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Post $post,Request $request)
    {
        $post->update($request->all());
        return "Update Post";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Post $post)
    {
        $post->delete();
        return "Deleted Post";
    }
}
