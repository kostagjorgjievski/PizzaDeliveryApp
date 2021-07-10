@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('items.create') }}" class="btn btn-success mb-3">Add Menu Item</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Menu Items
        </div>
        <div class="card-body">
            @if($items->count() > 0)
                <table class="table">
                    <thead>
                        <th>Image</th>
                        <th>Item Title</th>
                        <th>Food Category</th>
                        <th>Availability</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                        @foreach($items->all() as $item)
                            <tr>
                                <td>
                                    <img src="storage/{{ $item->image }}" width="120p" height="60px" alt="Error"> 
                                </td>
                                <td>
                                    {{ $item->title }}
                                </td>
                                <td>
                                    {{ $item->category->name }}
                                </td>
                                <td>
                                    @if($item->inStock)
                                        <i class="fas fa-check-circle pl-3 text-success"></i>
                                    @else
                                        <i class="fas fa-times-circle text-danger pl-3" aria-hidden="true"></i>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->price}}
                                </td>                              
                                <td>
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-success btn-sm" style="color: white">Update</a>
                                    <button class="btn btn-danger btn-sm" onclick="handleDelete( {{$item->id}} )" >Delete</button>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else 
                No menu items yet
            @endif
            <form action="" method="POST" id="deleteItemForm">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Item</h5>
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
            var form = document.getElementById('deleteItemForm')
            form.action = '/items/' + id;
        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
@endsection