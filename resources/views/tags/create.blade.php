@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        Add tag!
    </div>
    <div class="card-body">
        @include('partials.error')
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name">
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