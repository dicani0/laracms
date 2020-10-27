@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        Add category!
    </div>
    <div class="card-body">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
        @endforeach
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
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