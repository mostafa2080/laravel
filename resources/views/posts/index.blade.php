@extends('layouts.app')
@section('title')
    Posts
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center m-4" >
    <a href="{{ route('posts.create') }}" class="btn btn btn-success">New Post</a>
  </div>
  <div class="d-flex justify-content-center align-items-center m-4">
  <a href="{{ route('posts.restore') }}"
  onclick="return confirm('{{ __('Are you sure you want to Restore All Posts?') }}')"
  class="btn btn-danger form-control mt-5">Restore All Posts</a>
</div>
    <div class="table-responsive">
        <caption>Posts</caption>
        <table
            class="table table-striped
        table-hover
        table-borderless
        table-primary
        align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Author</th>
                    {{-- <th>published_at</th> --}}
                    <th>Slug</th>
                    <th>created_at</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($posts as $post)
                    <tr class="table-primary">
                        <td scope="row">{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description}}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->slug}}</td>
                        {{-- <td>{{ $post->published_at  }}</td> --}}
                        <td>{{ $post->created_at->diffForHumans()  }}</td>
                        <td><a href="{{ route('posts.show', $post['id']) }}" class="btn btn-success">View</a></td>
                        <td>
                            <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('posts.destroy',  $post->id) }}" method="POST" id={{ $post['id'] }}>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <script>
                                    document.getElementById("{{ $post['id'] }}").addEventListener("submit", function(event) {
                                        if (!confirm("Are you sure you want to delete this post?")) {
                                            event.preventDefault();
                                        }
                                    });
                                    </script>
                                    </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
    <div class="pagination justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection
