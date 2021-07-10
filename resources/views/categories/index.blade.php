@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Add Category</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Menu items</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($categories->all() as $category)
                            <tr>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    <a href="{{route('items.index') }}" class="pl-4">{{ $category->items->count()}} </a>
                                </td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-sm float-right mr-5" style="color: white">Update</a>
                                    <button class="btn btn-danger btn-sm float-right mr-2" onclick="handleDelete( {{$category->id}} )" >Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else 
                No categories yet
            @endif
            <form action="" method="POST" id="deleteCategoryForm">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
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
            var form = document.getElementById('deleteCategoryForm')
            form.action = '/categories/' + id;
        }
    </script>
@endsection