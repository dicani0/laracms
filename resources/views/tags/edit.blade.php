@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        Edit tag!
    </div>
    <div class="card-body">
        @include('partials.error')
        <form action="{{ route('tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name" value="{{ $tag->name }}">
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    Update!
                </button>
            </div>
        </form>
    </div>
</div>
@endsection