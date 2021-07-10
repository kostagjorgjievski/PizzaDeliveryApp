@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">My Profile</div>
        <div class="card-body">
            @include('partials.errors')
            
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" disabled class="form-control" name="name" id="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" disabled class="form-control" name="name" id="name" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label for="name">Phone</label>
                    <input type="text" disabled class="form-control" name="name" id="name" value="{{ $user->phone }}">
                </div>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success" style="white" >Edit Profile</a>
            </form>
        </div>
</div>
<div class="card my-5">
    <div class="card-header">My Adresses</div>
            <table class="table">
                <thead>
                    <th>Address</th>
                    <th>Municipality</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($user->address as $address)
                        <tr>
                            <td>
                                {{ $address->address }}
                            </td>
                            <td>
                                {{ $address->municipality }} 
                            </td>
                            <td>
                                <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-info btn-sm" style="color: white;">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete( {{$address->id}} )"  >Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>               
             </table>
    
    <div class="card-body">
        <a href="{{ route('addresses.create') }}" class="btn btn-success" style="white" >Add new</a>
    </div>
</div>
            <form action="" method="POST" id="deleteAddressForm">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Address</h5>
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

@endsection

@section('scripts')
    <script>
        function handleDelete(id){
            $('#deleteModal').modal('show');
            var form = document.getElementById('deleteAddressForm')
            form.action = '/addresses/' + id;
        }
    </script>
@endsection