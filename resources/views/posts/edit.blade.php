@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        Edit post!
    </div>
    <div class="card-body">
        @include('partials.error')
        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title" value="{{ $post->title }}">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                    <option {{ ($category->id==$post->category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ $post->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" id="content" name="content" value="{{ $post->content }}">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <label for="published_at">Published at</label>
                <input type="text" id="published_at" class="form-control" name="published_at" value="{{ $post->published_at }}">
            </div>
            <div class="form-group">
                <img src="{{ asset('storage/' . $post->image) }}" alt="" class="img-fluid">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="tags">Tags<small class="text-muted">(hold ctrl to select multiple tags)</small></label>
                <select class="form-control" name="tags[]" id="tags" multiple>
                    @foreach ($tags as $tag)
                    <option @if ($post->hasTag($tag->id))
                        selected
                        @endif
                        value="{{ $tag->id }}">{{ $tag->name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    Edit!
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js" integrity="sha512-S9EzTi2CZYAFbOUZVkVVqzeVpq+wG+JBFzG0YlfWAR7O8d+3nC+TTJr1KD3h4uh9aLbfKIJzIyTWZp5N/61k1g==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr('#published_at', {
        enableTime: true,
        time_24hr: true,
    });
</script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css" integrity="sha512-EQF8N0EBjfC+2N2mlaH4tNWoUXqun/APQIuFmT1B+ThTttH9V1bA0Ors2/UyeQ55/7MK5ZaVviDabKbjcsnzYg==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection