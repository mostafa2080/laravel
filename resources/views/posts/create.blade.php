@extends('layouts.app')
@section('title')
    New Post
@endsection

@section('content')
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Title</label>
            <input type="text" class="form-control" name="" id="" placeholder="">
            <small class="form-text text-muted">Enter Post Title</small>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <div class="mb-3">
                <label for="" class="form-label"></label>
                <textarea class="form-control" name="" id="" rows="5"></textarea>
            </div>
            <small class="form-text text-muted">Enter Post Description</small>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <select class="form-control" name="author" id="author">
                <option value="mostafa">Mostafa</option>
                <option value="youssef">Youssef</option>
            </select>
            <small class="form-text text-muted">Select Post Author</small>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
