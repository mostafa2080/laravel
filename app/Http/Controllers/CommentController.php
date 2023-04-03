<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $id){

        $post = Post::where('id', $id)->first();
        $comment = request()->comment;
        $post->comments()->create([
            'comment' => $comment,
        ]);;
        return redirect()->back();
    }
    public function destroy($id){
        $comment = Comment::where('id', $id)->first();
        // dd($id);
        $comment->delete();
        return redirect()->back();
    }
}
