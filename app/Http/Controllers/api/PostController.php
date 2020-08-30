<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    

   public function __construct(Post $post){
     $this->post = $post;
   }


    public function index()
    {
        $post = $this->post->orderBy('id','DESC')->get();
        return response()->json(new PostCollection($post));
    }

   
    public function store(PostRequest $request)
    {
        $post = $this->post->create($request->all());
        return response()->json(new PostResource($post),201);
    }

   
    public function show(Post $post)
    {
        return response()->json(new PostResource($post));
    }

   
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->all());
        return response()->json(new PostResource($post));

    }

    
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['message'=>'posts delete'],204);
    }
}
