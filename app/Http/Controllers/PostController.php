<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store(StorePostRequest $request)
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

    public function update(UpdatePostRequest $request, $id)
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
        $comment = $post->comments()->create([
            'comment' => $data['comment']
        ]);
        $comments = Comment::where('commentable_id', $id)->get();
        return view('posts.show', compact('post', 'comments'));
        // return view('posts.show', ['comments' => $comments]);
    }

    public function show($id)
{
    $post = Post::findOrFail($id);
    $comments = Comment::where('commentable_id', $id)->get();

    return view('posts.show', compact('post', 'comments'));
}

    public function restore()
    {
        Post::withTrashed()
            ->restore();
        return redirect()->back();
    }
}



























