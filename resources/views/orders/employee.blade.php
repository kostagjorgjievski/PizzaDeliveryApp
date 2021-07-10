@extends('layouts.app')
@section('content')

<div class="card card-default">
<div class="card-header">
	All Orders
</div>
<div class="card-body">
	<table class="table">
		<thead>
            <th>Name</th>
            <th>Items</th>
            <th>Address</th>
			<th>Status</th>
			<th>Progress</th>
			<th>Price</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($orders as $order)
			<tr>
                <td>
                    {{ $order->user->name }}
                </td>
				<td>
					@foreach($order->items as $item)
					<h4> {{ $item->title }} </h4>
					@endforeach
                </td>
                <td>
                    {{ $order->address}}
                </td>
				<td>
                    <h5>{{ $order->status}}</h5>   
				</td>
				<td>
					<form action="{{ route('orders.updateOrder', $order->id) }}" method="POST" style="display: inline;">
						@csrf
						@method('PUT')
						<?php 
							if($order->progress != 'recieved')
							{
								$color = 'btn-danger';
							}
							else
							{
								$color = 'btn-success';
							}
						?>
						<button style="align-items: center;" class="btn {{ $color }} mb-3"> 
							<input type="hidden" name="progress" id="progress" value="recieved">
							Recived
						</button>
					</form>
					<form action="{{ route('orders.updateOrder', $order->id) }}" method="POST" style="display: inline;">
						@csrf
						@method('PUT')
						<input type="hidden" name="progress" id="progress" value="making">
						<?php 
							if($order->progress != 'making')
							{
								$color = 'btn-danger';
							}
							else
							{
								$color = 'btn-success';
							}
						?>
						<button style="align-items: center;" class="btn {{ $color }} mb-3">
							Prepearing
						</button>
					</form>
					<form action="{{ route('orders.updateOrder', $order->id) }}" method="POST" style="display: inline;">
						@csrf
						@method('PUT')
						<input type="hidden" name="progress" id="progress" value="baking">
						<?php 
							if($order->progress != 'baking')
							{
								$color = 'btn-danger';
							}
							else
							{
								$color = 'btn-success';
							}
						?>
						<button style="align-items: center;" class="btn {{ $color }} mb-3 "
						>
							Baking
						</button>
					</form>
					<form action="{{ route('orders.updateOrder', $order->id) }}" method="POST" style="display: inline;">
						@csrf
						@method('PUT')
						<input type="hidden" name="progress" id="progress" value="sent">
						<?php 
							if($order->progress != 'sent')
							{
								$color = 'btn-danger';
							}
							else
							{
								$color = 'btn-success';
							}
						?>
						<button style="align-items: center;" class="btn {{$color}} mb-3">
							On The Way
						</button>
					</form>
					<form action="{{ route('orders.updateOrder', $order->id) }}" method="POST" style="display: inline;">
						@csrf
						@method('PUT')
						<input type="hidden" name="progress" id="progress" value="finished">
						<?php 
							if($order->progress != 'finished')
							{
								$color = 'btn-danger';
							}
							else
							{
								$color = 'btn-success';
							}
						?>
						<button style="align-items: center;" class="btn {{$color}} mb-3">
							Finished
						</button>
					</form>

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