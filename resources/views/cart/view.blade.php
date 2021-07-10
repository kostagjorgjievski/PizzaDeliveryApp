@extends('layouts.app')
@section('content')
<?php $total = 0 ?>
@foreach((array) session('cart') as $items => $item)
<?php $total += $item['price'] * $item['quantity'] ?>
@endforeach
<div class="card mb-3">
	<div class="card-body " style="display: inline;">
		<h4 style="display: inline;">Total Cost:</h4>
		<h3 class="text-success" style="display: inline;">{{$total}} денари</h3>
		@if($total != 0)
		<button type="button" class="btn btn-success text-white float-right" data-toggle="modal" data-target="#orderModal">Place Order</button>
		@endif                                
	</div>
</div>
<div class="card card-default">
<div class="card-header">
	Cart Items
</div>
<div class="card-body">
	@if(isset($cart))
	<table class="table">
		<thead>
			<th>Image</th>
			<th>Item Title</th>
			<th>Quantity</th>
			<th>Price</th>
			<th><a href="{{ route('cart.index') }}" class="btn btn-success text-white btn-sm" >Add More Items</a> </th>
		</thead>
		<tbody>
			<?php $total = 0 ?>
			@foreach($cart as $items => $item)
			<tr>
				<td>
					<img width='170px' height='100px' src="/storage/{{ $item['image'] }}" alt="">
				</td>
				<td>
					<h4>{{ $item['title'] }}</h4>
				</td>
				<td>
					<h5 style="display: inline;">{{ $item['quantity'] }}</h5>
					<form action="{{ route('cart.update-cart') }}" method="POST" style="display: inline;">
						@csrf
						@method('PUT')
						<input type="hidden" name='items' id='items' value="{{ $items }}">
						<input type="hidden" name='operator' id='operator' value="+">
						<input type="hidden" name='quantity' id='quantity' value="{{ $item['quantity']}}">
						<button type="submit" class="btn btn-success btn-sm text-white"><i class="fa fa-plus" aria-hidden="true"></i></button> 
					</form>
					<form action="{{ route('cart.update-cart') }}" method="POST" style="display: inline;">
						@csrf
						@method('PUT')
						<input type="hidden" name='items' id='items' value="{{ $items }}">
						<input type="hidden" name='operator' id='operator' value="-">
						<input type="hidden" name='quantity' id='quantity' value="{{ $item['quantity']}}">
						@if($item['quantity'] == "1")
						<a class="btn btn-danger btn-sm text-white"><i class="fa fa-minus" aria-hidden="true"></i></a>
						@else
						<button type="submit" class="btn btn-danger btn-sm text-white"><i class="fa fa-minus" aria-hidden="true"></i></button>
						@endif
					</form>
				</td>
				<td>
					<h5>{{ $item['price'] }}denari</h5>
				</td>
				<td class="actions">
					<form action="{{ route('cart.delete-item') }}" method="POST" style="display: inline;">
						@csrf
						@method('DELETE')
						<input type="hidden" name='items' id='items' value="{{ $items }}">
						<button type="submit" class="btn btn-danger btn-sm" >Remove from cart</button>
					</form>
				</td>
			</tr>
			@endforeach 
		</tbody>
	</table>
</div>
@else

No items in the cart

@endif
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="orderModal">Place Order</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				<table class="table">
					<thead>
						<th>Item</th>
						<th>Quantity</th>
						<th>Price</th>
						<th></th>
					</thead>
					<tbody>
						@foreach($cart as $items => $item)
						<tr>
							<td>
								<h5>
									{{ $item['title']}}
								</h5>
							</td>
							<td>
								<h5>
									{{ $item['quantity']}}
								</h5>
							</td>
							<td>
								<h5>
								{{ $item['price']}} денари
								<h5>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@foreach((array) session('cart') as $items => $item)
				<?php $total += $item['price'] * $item['quantity'] ?>
				@endforeach
				<hr>
				<form action="{{ route('orders.store') }}" enctype="multipart/form-data" method="POST">
					@csrf
					<div class="form-group">
						<label for="address">Address</label>
						<select name="address" id="address" class="form-control">
							@foreach(auth()->user()->address as $address)
							<option value="{{ $address->address }}">
								{{ $address->address }}
							</option>
							@endforeach
						</select>
						<a class="text-primary" href="{{ route('addresses.create') }}">Add a new address</a>
					</div>
					<hr>
					<h5>Total Cost: {{$total}} денари</h5>
					<div class="form-group">
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-success">Place Order</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@endsection