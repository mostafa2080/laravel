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

    @foreach($comments as $comment)
    <div class="card mt-4 mb-3">
        <div class="card-body">
            <p class="card-text">{{ $comment->comment }} <span class="small text-muted">{{ $comment->created_at->diffForHumans() }}</span></p>
            <div class="d-flex">
                <a href="{{ route('comments.edit', [$comment->id])  }}" class="btn btn-secondary mr-2">Edit</a>
                <form action="{{ route('comments.destroy', [$comment->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endforeach


    {{-- @foreach($comments as $comment)

    <div class="card mt-4 mb-3">
        <div class="card-body">
        <p class="card-text">{{ $comment->comment }} <span class="small text-muted">{{ $comment->created_at->diffForHumans() }}</span></p>
        <form action="{{ route('comments.destroy', [$comment->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        </div>
    </div>
    @endforeach --}}

    {{-- @foreach($comments as $comment)

    <div class="card mt-4 mb-3">
        <div class="card-body">
        <p class="card-text">{{ $comment->comment }} <span class="small text-muted">{{ $comment->created_at->diffForHumans() }}</span></p>
        <div class="d-flex">
            <a href="{{ route('comments.update', [$comment->id]) }}" class="btn btn-secondary mr-2">Edit</a>
            <form action="{{ route('comments.destroy', [$comment->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        </div>
    </div>

    @endforeach --}}


    {{-- @foreach($comments as $comment)
    <div class="card mt-4 mb-3">
        <div class="card-body">
        <p class="card-text">{{ $comment->comment }} <span class="small text-muted">{{ $comment->created_at->diffForHumans() }}</span></p>
        <div class="d-flex">
            <a href="#" class="btn btn-secondary mr-2 edit-comment">Edit</a>
            <form action="{{ route('comments.destroy', [$comment->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        <div class="comment-edit-form d-none">
            <textarea class="form-control mb-2">{{ $comment->comment }}</textarea>
            <button type="button" class="btn btn-primary update-comment">Update</button>
            <button type="button" class="btn btn-secondary cancel-comment-edit ml-2">Cancel</button>
        </div>
        </div>
    </div>
    @endforeach

    <script>
        function route(name, parameters = {}) {
        let url = "{{ route('comments.update', [$post->id]) }}";
        for (const [key, value] of Object.entries(parameters)) {
            url = url.replace(':' + key, value);
        }
        url = url.replace('/{.*?}/g', '');
        url = url.replace('//', '/');
        return url.replace('{{ route('comments.update', [$post->id]) }}', name);
        }

        const editButtons = document.querySelectorAll('.edit-comment');
        editButtons.forEach(editButton => {
        editButton.addEventListener('click', () => {
            const cardBody = editButton.closest('.card-body');
            const commentText = cardBody.querySelector('.card-text');
            const commentEditForm = cardBody.querySelector('.comment-edit-form');
            commentText.classList.add('d-none');
            commentEditForm.classList.remove('d-none');
        });
        });

        const updateButtons = document.querySelectorAll('.update-comment');
        updateButtons.forEach(updateButton => {
        updateButton.addEventListener('click', () => {
            const cardBody = updateButton.closest('.card-body');
            const commentText = cardBody.querySelector('.card-text');
            const commentEditForm = cardBody.querySelector('.comment-edit-form');
            const textarea = commentEditForm.querySelector('textarea');
            const commentId = cardBody.dataset.commentId;
            const formData = new FormData();
            formData.append('comment', textarea.value);
            formData.append('_method', 'PUT');
            fetch(route('comments.update', { comment: commentId }), {
            method: 'POST',
            body: formData,
            })
            .then(response => response.json())
            .then(data => {
            commentText.querySelector('p').textContent = data.comment;
            commentText.classList.remove('d-none');
            commentEditForm.classList.add('d-none');
            })
            .catch(error => {
            console.error(error);
            });
        });
        });

        const cancelButtons = document.querySelectorAll('.cancel-comment-edit');
        cancelButtons.forEach(cancelButton => {
        cancelButton.addEventListener('click', () => {
            const cardBody = cancelButton.closest('.card-body');
            const commentText = cardBody.querySelector('.card-text');
            const commentEditForm = cardBody.querySelector('.comment-edit-form');
            commentText.classList.remove('d-none');
            commentEditForm.classList.add('d-none');
        });
        });
    </script> --}}




    @endsection
