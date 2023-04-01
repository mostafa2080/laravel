<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\TextUI\Configuration\Constant;

class PostController extends Controller
{
    //action methods
    public function index()
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'Post 1',
                'description' => 'Post 1 description',
                'author' => 'mostafa',
                'published_at' => '2023-04-1',
                'created_at' => '2023-04-1',
            ],
            [
                'id' => 2,
                'title' => 'Post 2',
                'description' => 'Post 2 description',
                'author' => 'youssef',
                'published_at' => '2023-04-1',
                'created_at' => '2023-04-1',
            ],
            [
                'id' => 3,
                'title' => 'Post 3',
                'description' => 'Post 3 description',
                'author' => 'osama',
                'published_at' => '2023-04-1',
                'created_at' => '2023-04-1',
            ],
            [
                'id' => 4,
                'title' => 'Post 4',
                'description' => 'Post 4 description',
                'author' => 'saber',
                'published_at' => '2023-04-1',
                'created_at' => '2023-04-1',
            ],
        ];
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        return redirect()->route('posts.index');
    }

    public function show()
    {
        $post = [
            'id' => 1,
            'title' => 'Post 1',
            'description' => 'Post 1 description',
            'author' => 'mostafa',
            'published_at' => '2023-04-1',
            'created_at' => '2023-04-1',
        ];

        return view('posts.show', ["post" => $post]);
    }

    public function edit()
    {
        $post = [
            'id' => 1,
            'title' => 'Post 1',
            'description' => 'Post 1 description',
            'author' => 'mostafa',
            'published_at' => '2023-04-1',
            'created_at' => '2023-04-1',
        ];

        return view('posts.edit', ["post" => $post]);
    }


    public function update()
    {
        return redirect()->route('posts.index');
    }


    public function destroy()
    {
        return redirect()->route('posts.index');
    }
}
