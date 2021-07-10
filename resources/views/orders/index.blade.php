@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-end">
	<a href="{{ route('items.create') }}" class="btn btn-success mb-3">Add Menu Item</a>
</div>
<div class="card card-default">
<div class="card-header">
	My Order
</div>
<div class="card-body">
	<table class="table">
		<thead>
			<th>Items</th>
			<th>Status</th>
			<th>Progress</th>
			<th>Price</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($orders as $order)
			<tr>
				<td>
					@foreach($order->items as $item)
					<h4> {{ $item->title }} </h4>
					@endforeach
				</td>
				<td>
					<h5>{{ $order->status }}</h5>
				</td>
				<td>
				<?php $order_progress_text = '' ?>
						<?php 
							if($order->progress != 'recieved')
							{
								$color = 'btn-danger';
							}
							else
							{
								$color = 'btn-success';
								$order_progress_text = 'Your order has been recived.';
							}
						?>
						<button style="align-items: center;" class="btn {{ $color }} mb-3"> 
							<input type="hidden" name="progress" id="progress" value="recieved">
							Recived
						</button>
						<?php 
							if($order->progress != 'making')
							{
								$color = 'btn-danger';
							}
							else
							{
								$color = 'btn-success';
								$order_progress_text = 'The order is being prepared by our pizza chef.';
							}
						?>
						<button style="align-items: center;" class="btn {{ $color }} mb-3">
							Prepearing
						</button>

						<?php 
							if($order->progress != 'baking')
							{
								$color = 'btn-danger';
							}
							else
							{
								$color = 'btn-success';
								$order_progress_text = 'The order is in the oven slowly baking.';
							}
						?>
						<button style="align-items: center;" class="btn {{ $color }} mb-3 "
						>
							Baking
						</button>

						<?php 
							if($order->progress != 'sent')
							{
								$color = 'btn-danger';
							}
							else
							{
								$color = 'btn-success';
								$order_progress_text = 'The order is on the way to your home';
							}
						?>
						<button style="align-items: center;" class="btn {{$color}} mb-3">
							On The Way
						</button>
						<h5>
							{{$order_progress_text}}
						</h5>
				</td>
				<td>
					{{ $order->cost }} денари
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
@section('scripts')
	<script>
		setTimeout(function() {
		location.reload();
		}, 5000);
	</script>
@endsection