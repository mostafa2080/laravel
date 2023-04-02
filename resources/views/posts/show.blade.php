@extends('layouts.app')
@section('title')
    Post Details
@endsection

@section('content')
    <h1><span style="color:red">Name: </span> {{ $post['title'] }}</h1>
    <p><span style="color:red">Descrription: </span> {{ $post['description'] }}</p>
    <p><span style="color:red">Created-At: </span>{{ $post->created_at}}</p>

    <div class="card mt-4">
        <div class="card-header">
            Post Author Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Author Name: {{ $post->user->name }}</h5>
            <p class="card-text">Author Mail: {{ $post->user->email }}</p>
        </div>
    </div>




@endsection
