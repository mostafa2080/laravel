<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::with('comments')->where('id', $id)->first();
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
        ]);

        return to_route('posts.index');
    }

    public function edit($id)
    {

        $users = User::all();
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = $request->user_id;
        }
        $post->save();

        return to_route('posts.index');
    }

    // public function destroy($id)
    // {
    //     $post = Post::find($id);
    //     if ($post) {
    //         $post->delete();
    //     }
    //     return redirect()->route('posts.index');
    // }

    public function destroy($id){
        $post = Post::where('id', $id)->first();
        $post->delete();
        // return redirect()->route('posts.index', $post['user_id'] );
        return redirect()->route('posts.index', ['user_id' => $post->user_id]);

    }


    public function addComment($id, Request $request)
    {
        $data = $request->all();
        $post = Post::findOrFail($id);
        $post->comments()->create([
            'filename' => $data['filename']
        ]);
        return redirect()->back();
    }


    public function restore()
    {
        Post::withTrashed()
            ->restore();
        return redirect()->back();
    }
}
