@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        Add post!
    </div>
    <div class="card-body">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
        @endforeach
        @endif
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="published_at">Published at</label>
                <input type="text" id="published_at" class="form-control" name="published_at">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    Add!
                </button>
            </div>
        </form>
    </div>
</div>
@endsection