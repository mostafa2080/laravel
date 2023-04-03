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



    // public function update(Request $request, $id)
    // {
    //     $comment = Comment::find($id);
    //     if ($comment) {
    //         $comment->comment = $request->comment;
    //         $comment->save();
    //     }

    //     return redirect()->route('posts.show', $comment->post_id);
    // }



public function edit($commentId)
{
    $comment = Comment::findOrFail($commentId);
    return view('posts.editComment', ['comment' => $comment]);
}

public function update(Request $request, $commentId)
{
    $comment = Comment::findOrFail($commentId);
    $comment->comment = $request->input('comment');
    $comment->save();


    $post = Post::findOrFail($comment->commentable_id);
    return redirect()->route('posts.show', ['post' => $post->id]);


    // return redirect()->back();

}








}

