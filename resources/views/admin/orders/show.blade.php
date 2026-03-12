@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
<section class="content pt-3">

<div class="card">

<div class="card-header">
<h3>Order #{{ $order->id }}</h3>
</div>

<div class="card-body">

<h5>Customer</h5>

<p>
Name: {{ $order->user->name ?? 'Guest' }} <br>
Email: {{ $order->user->email ?? '' }}
</p>

<hr>

<h5>Products</h5>

<table class="table table-bordered">

<thead>
<tr>
<th>Product</th>
<th>Qty</th>
<th>Price</th>
<th>Total</th>
</tr>
</thead>

<tbody>

@foreach($order->items as $item)

<tr>

<td>
{{ $item->product->name }}
</td>

<td>
{{ $item->quantity }}
</td>

<td>
${{ $item->price }}
</td>

<td>
${{ $item->price * $item->quantity }}
</td>

</tr>

@endforeach

</tbody>

</table>

<hr>

<h4>Total: ${{ number_format($order->total,2) }}</h4>

</div>
</div>

</section>
</div>

@endsection