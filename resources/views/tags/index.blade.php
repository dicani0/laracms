@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        Tags
        <a href="{{ route('tags.create') }}" class="btn btn-primary">Add tag</a>
    </div>
    <div class="card-body">
        @if($tags->count()>0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Posts count</th>
                <th class="text-right">Action</th>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }} </td>
                    <td>{{ $tag->posts()->count() }}</td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a class="btn btn-info" href="{{ route('tags.edit', $tag) }}"><i class="fas fa-pen"></i></a>
                            <a class="btn btn-danger" onclick="deletetag({{ $tag->id }}, '{{ $tag->name }}')"><i class="fas fa-times"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deletetagForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete tag</h5>
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
        @else
        <div class="alert alert-danger">No tags found!</div>
        @endif
    </div>
</div>
@endsection
@section('scripts')
<script>
    function deletetag(id, name){
        var form = $('#deletetagForm')[0];
        // var form = document.getElementById('deletetagForm');
        $('#modalBody').html('Delete tag ' + name);
        form.action= '/tags/' + id;
        $('#deleteModal').modal('show');
        console.log(form);
    }
</script>
@endsection