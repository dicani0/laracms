@extends('layouts.app')
@section('content')
<div class="card bg-dark text-white">
    <img src="{{ asset('storage/' . $post->image) }}" alt="" class="card-img-top">
    <div class="card-header">
        <p class="display-4">{{ $post->title }}</p>
        <span>by {{ $post->user->name }}</span>
    </div>
    <div class="card-body">
        <p class="font-weight-bold">{{ $post->description }}</p>
        <p>{!! $post->content !!}</p>
    </div>
    <div class="card-footer">
        @foreach ($post->tags as $tag)
        <span class="badge badge-pill badge-primary">{{ $tag->name }}</span>
        @endforeach
    </div>
</div>
@endsection