@extends('layouts.app')

@section('content')
    @include('partials.errors')
    @foreach($items as $item)
    <div class="container my-4 mr-5" style="width: 300px; display: inline-block;">
        <div class="post">
            <div class="header_post">
                <img src="/storage/{{$item->image}}" alt="">
            </div>
                @csrf
                @method('PUT')
                <div class="body_post">
                    <div class="post_content" style="text-align: center;">

                        <h1>{{ $item->title }}</h1>
                        <p>{{ $item->description }}</p>
                        <input type="hidden" id="item_id" name="item_id" value="{{ $item->id }}">
                        
                        <div class="container_infos">
                            @if($item->inStock)                            
                                <a href="{{ route('cart.addToCart', $item->id) }}" class="btn btn-success" style="margin: auto; display:block;">Add to cart</a>
                            @else
                            <a  class="btn btn-info" style="margin: auto; display:block; color: white;">Out of Stock</a>    
                            @endif
                            <h1 style="margin: auto;">{{ $item->price }}den</h1>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
        
@endsection



@section('css')
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    
@endsection