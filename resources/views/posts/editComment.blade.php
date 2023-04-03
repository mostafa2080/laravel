@extends('layouts.app')
@section('title')
    Edit Comment
@endsection
@section('content')
<form method="POST" action="{{ route('comments.update', ['comment' => $comment->id]) }}" class="mt-3">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="comment">Edit your comment:</label>
        <textarea name="comment" id="comment" class="form-control">{{ $comment->comment }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
