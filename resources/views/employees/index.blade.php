@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">Add Employee</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Employees
        </div>
        <div class="card-body">
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($users->all() as $user)
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    {{ $user->role }}
                                </td>
                                <td>                                   
                                    <button class="btn btn-danger btn-sm float-right" onclick="handleDelete({{$user->id}})" >Remove</button>
                                    <a href="{{ route('employees.edit', $user->id) }}" class="btn btn-primary btn-sm float-right mr-2" style="color: white">Update</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else 
                No users yet
            @endif
            <form action="" method="POST" id="deleteUserForm">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                This action is irreversible
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                                <button type="submit" class="btn btn-danger">Yes, delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id){
            $('#deleteModal').modal('show');
            var form = document.getElementById('deleteUserForm')
            form.action = '/employees/' + id;
        }
    </script>
@endsection