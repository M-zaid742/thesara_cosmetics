@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Orders</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('orders.track', $order->id) }}" class="btn btn-info btn-sm">Track Order</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $orders->links() }} <!-- Pagination -->
</div>
@endsection