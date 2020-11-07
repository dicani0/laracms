@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        Posts
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add post</a>
    </div>
    <div class="card-body">
        @if ($posts->count()>0)
        <table class="table">
            <thead>
                <td>Image</td>
                <th>Title</th>
                <th>Category</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>
                        <img class="img-fluid" src="{{ asset('storage/'.$post->image) }}" alt="">
                    </td>
                    <td>
                        {{ $post->title }}

                    </td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-success" href="{{ route('posts.show', $post) }}"><i class="fas fa-info-circle"></i></a>
                            @if (!$post->trashed())
                            <a class="btn btn-info" href="{{ route('posts.edit', $post) }}"><i class="fas fa-pen"></i></a>
                            @else
                            <form action="{{ route('restore-posts', $post) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-info"><i class="fas fa-recycle"></i></button>
                            </form>

                            @endif
                            <a onclick="deletePost({{ $post->id }}, '{{ $post->title }}')" class="btn btn-danger">{!! $post->trashed() ? '<i class="fas fa-times"></i>' : '<i class="fas fa-trash"></i>' !!}</a>


                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-danger">No posts found!</div>
        @endif

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deletePostForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modalBody">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Never mind</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function deletePost(id, title){
        var form = $('#deletePostForm')[0];
        $('#modalBody').html('Delete post ' + title);
        form.action= '/posts/' + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection