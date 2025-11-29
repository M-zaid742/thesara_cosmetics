{{-- resources/views/checkout.blade.php --}}
@extends('layouts.app')

@section('title', 'Checkout - Thesara Cosmetics')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endsection

@section('content')

<div class="container py-5">
    <h2 class="fw-bold mb-4">Checkout</h2>

    <div class="row">
        <!-- Billing Details -->
        <div class="col-lg-7">
            <div class="checkout-box p-4 mb-4">
                <h5 class="fw-bold mb-3">Billing Information</h5>

                <form>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" placeholder="Enter your full name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" placeholder="example@gmail.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" placeholder="+92 300 1234567">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Shipping Address</label>
                        <textarea class="form-control" rows="3" placeholder="House #, Street, City"></textarea>
                    </div>
                </form>
            </div>

            <div class="checkout-box p-4">
                <h5 class="fw-bold mb-3">Payment Method</h5>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="payment" checked>
                    <label class="form-check-label">Cash on Delivery (COD)</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment">
                    <label class="form-check-label">Credit/Debit Card</label>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-5">
            <div class="summary-box p-4">
                <h5 class="fw-bold mb-3">Order Summary</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span id="summary-subtotal">$0.00</span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping</span>
                    <span>$5.00</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                    <span>Total</span>
                    <span id="summary-total">$0.00</span>
                </div>

                <button class="btn btn-dark w-100 py-2">
                    <i class="fas fa-check me-2"></i>Place Order
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/checkout.js') }}"></script>
@endsection
