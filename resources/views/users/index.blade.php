@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        Users
    </div>
    <div class="card-body">
        @if ($users->count()>0)
        <table class="table">
            <thead>
                <th>Full name</th>
                <th>Email</th>
                <th>Role</th>
                <th>About</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        {{ $user->name }}
                        <img src="{{ Gravatar::get($user->email) }}" alt="">

                    </td>
                    <td>
                        {{ $user->email }}

                    </td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->about }}</td>
                    <td>
                        <div class="btn-group">
                            <a onclick="deleteUser({{ $user->id }}, '{{ $user->fullname }}')" class="btn btn-danger"><i class="fas fa-times"></i></a>
                            @if (!$user->isAdmin())
                            <form action="{{ route('users.give-admin', $user) }}" method="post">
                                @csrf
                                <button class="btn btn-secondary" type="submit">Give admin</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-danger">No users found!</div>
        @endif

        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="" method="POST" id="deleteUserForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
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
    </div>
</div>
@endsection
@section('scripts')
<script>
    function deletePost(id, title){
        var form = $('#deleteUserForm')[0];
        $('#modalBody').html('Delete post ' + title);
        form.action= '/posts/' + id;
        $('#deleteModal').modal('show');
    }
</script>
@endsection