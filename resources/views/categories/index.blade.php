@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        Categories 
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add category</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <th>Name</th>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td class="d-flex justify-content-between align-items-center">{{ $category->name }}<a class="btn btn-info ml-auto" href="{{ route('categories.edit', $category->id) }}">Edit category</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection