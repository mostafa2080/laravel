<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePostRequest;




class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allPosts=Post::all();
       return PostResource::collection($allPosts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $post=Post::create([
            'title'=>request()->title,
            'description'=>request()->description,
            'user_id' => request()->user_id,
        ]);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::findOrFail($request->post_id);
        if (Storage::exists("public/images/posts/{$post->image}")) {
            Storage::delete("public/images/posts/{$post->image}");
        }
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(storage_path('app/public/images/posts'), $imageName);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = auth('sanctum')->user()->id;
        $post->image = $imageName;
        $post->save();
        return new PostResource($post);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        DB::transaction(function () use ($post) {
            $comments = Comment::where(['commentable_id' => $post->post_id, 'commentable_type' => 'App\Models\Post'])->get();
            foreach ($comments as $comment) {
                $comment->delete();
            }
            $post = Post::where('user_id', auth('sanctum')->user()->id)->findOrFail($post->post_id);
            $post->delete();
        });

        return 'Post Deleted Successfully.';
    }
}
