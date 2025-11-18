{{-- resources/views/orders/track.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Track Your Order</h3>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('track.result') }}" method="GET">
                        <div class="mb-4">
                            <label for="order_id" class="form-label fs-5">Enter Order ID</label>
                            <input type="number" 
                                   name="order_id" 
                                   id="order_id"
                                   class="form-control form-control-lg text-center"
                                   placeholder="e.g. 12345" 
                                   required 
                                   autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            Track Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection