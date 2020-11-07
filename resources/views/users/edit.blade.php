@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Edit your profile!
        </div>
        <div class="card-body">
            <form action="{{route('users.update-profile')}}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="about">About</label>
                <textarea class="form-control" name="about" id="about" cols="30" rows="4">{{ $user->about }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
        </div>
        <div class="card-footer">

        </div>
    </div>
@endsection