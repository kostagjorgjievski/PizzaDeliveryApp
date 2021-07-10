@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($item) ? 'Edit Menu Item' : 'Create Menu Item'}}
        </div>
        <div class="card-body">

            @include('partials.errors')

            <form action="{{ isset($item) ? route('items.update', $item->id) : route('items.store') }}" enctype="multipart/form-data" method="POST">
                @csrf

                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id='title' value="{{ isset($item) ? $item->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="name">Description</label>
                    <textarea name="description" id="desctiption" class="form-control" cols="5" rows="5">{{ isset($item) ? $item->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price (only numbers)</label>
                    <input type="text" class="form-control" name="price" id='price' value="{{ isset($item) ? $item->price : '' }}">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" name="availability" id="availability" type="checkbox" value="1"
                        @if(isset($item))
                            @if($item->inStock == 1)
                                checked
                            @else
                                
                            @endif
                        @endif
                        >
                        <label class="form-check-label" for="availability"> It is Available </label>                    
                        
                    </div>
                </div>


                @if(isset($item))
                    <div class="form-group">
                        <img src="/storage/{{$item->image}}" alt="{{$item->image}}">
                    </div>                   
                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id='image'>
                </div>

                <div class="form-group">
                    <label for="category">Food Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @if(isset($item))
                                    @if($category->id == $item->category_id)
                                        selected
                                    @endif
                                @endif
                                >
                                {{$category->name}}  {{ $category->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($item) ? 'Update Item' : 'Create Menu Item' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection