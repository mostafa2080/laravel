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

{{-- Comments --}}

<form action="{{ route('comments.store', [$post->id]) }}" method="POST" class="mt-3">
    @csrf
    <div class="form-group">
      <label for="comment">Comment:</label>
      <textarea name="comment" id="comment" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save Comment</button>
  </form>

  {{-- <div>
    <h3>Comments</h3>
    @foreach($comments as $comment)
      <p>{{ $comment->comment }}</p>
    @endforeach
  </div> --}}

  @foreach($comments as $comment)
  <div class="card mt-4 mb-3">
    <div class="card-body">
      <p class="card-text">{{ $comment->comment }}</p>
      <form action="{{ route('comments.destroy', [$comment->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
    </div>
  </div>
@endforeach



@endsection
