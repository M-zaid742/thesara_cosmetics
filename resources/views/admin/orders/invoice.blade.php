@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
<section class="content pt-3">

<div class="card">

<div class="card-header">
<h3>Invoice #{{ $order->id }}</h3>
</div>

<div class="card-body">

<p>
Customer: {{ $order->user->name ?? 'Guest' }} <br>
Date: {{ $order->created_at->format('d M Y') }}
</p>

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

<td>{{ $item->product->name }}</td>

<td>{{ $item->quantity }}</td>

<td>Rs. {{ $item->price }}</td>

<td>Rs. {{ $item->price * $item->quantity }}</td>

</tr>

@endforeach

</tbody>

</table>

<h3 class="text-right">
Total: Rs. {{ number_format($order->total,2) }}
</h3>

</div>
</div>

</section>
</div>

@endsection