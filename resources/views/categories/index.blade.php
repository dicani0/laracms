@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        Categories
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add category</a>
    </div>
    <div class="card-body">
        @if($categories->count()>0)
        <table class="table">
            <thead>
                <th>Name</th>
                <th>Posts count</th>
                <th class="text-right">Action</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td><a href="{{ route('postsWithCategory', $category) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->posts()->count() }}</td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a class="btn btn-info" href="{{ route('categories.edit', $category) }}"><i class="fas fa-pen"></i></a>
                            <a class="btn btn-danger" onclick="deleteCategory({{ $category->id }}, '{{ $category->name }}')"><i class="fas fa-times"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deleteCategoryForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete category</h5>
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
        <div class="alert alert-danger">No categories found!</div>
        @endif
    </div>
</div>
@endsection
@section('scripts')
<script>
    function deleteCategory(id, name){
        var form = $('#deleteCategoryForm')[0];
        // var form = document.getElementById('deleteCategoryForm');
        $('#modalBody').html('Delete category ' + name);
        form.action= '/categories/' + id;
        $('#deleteModal').modal('show');
        console.log(form);
    }
</script>
@endsection