@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
<section class="content pt-3">

<div class="card">
<div class="card-header">
<h3 class="card-title">Orders Management</h3>
</div>

<div class="card-body">

<table class="table table-bordered table-striped">
<thead>
<tr>
<th>ID</th>
<th>Customer</th>
<th>Items</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@foreach($orders as $order)

<tr>

<td>#{{ $order->id }}</td>

<td>
{{ $order->user->name ?? 'Guest' }}
</td>

<td>
{{ $order->items->count() }}
</td>

<td>
Rs. {{ number_format($order->total,2) }}
</td>

<td>

<form action="{{ route('admin.orders.status',$order->id) }}" method="POST">

@csrf
@method('PUT')

<select name="status" class="form-control" onchange="this.form.submit()">

<option value="pending" {{ $order->status=='pending'?'selected':'' }}>
Pending
</option>

<option value="completed" {{ $order->status=='completed'?'selected':'' }}>
Completed
</option>

<option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>
Cancelled
</option>

</select>

</form>

</td>

<td>
{{ $order->created_at->format('d M Y') }}
</td>

<td>

<a href="{{ route('admin.orders.show',$order->id) }}"
class="btn btn-info btn-sm">
View
</a>

<a href="{{ route('admin.orders.invoice',$order->id) }}"
class="btn btn-success btn-sm">
Invoice
</a>

</td>

</tr>

@endforeach

</tbody>
</table>

</div>
</div>

</section>
</div>

@endsection