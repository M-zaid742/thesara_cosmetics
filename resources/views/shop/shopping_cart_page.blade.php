@extends('layouts.app')

@section('title', 'Shopping Cart - Thesara Cosmetics')

@section('styles')
    <!-- Cart specific CSS -->
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@section('content')

<!-- Main Content -->
<div class="container py-5">
    <h2 class="fw-bold mb-4">Your Shopping Cart</h2>

    <div class="row">
        <!-- Cart Items -->
        <div class="col-lg-8">
            <div class="cart-item mb-3" data-price="17.50">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="https://images.unsplash.com/photo-1556228720-195a672e8a03?w=300&h=300&fit=crop" alt="Hydragaurd SPF 50 Sunscreen" class="img-fluid rounded">
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-1">Hydragaurd SPF 50 Sunscreen</h6>
                        <p class="text-muted mb-1">Thesara Cosmetics</p>
                        <p class="fw-semibold item-price">$17.50</p>
                    </div>
                    <div class="col-md-3 d-flex align-items-center justify-content-center">
                        <button class="quantity-btn btn-decrease">-</button>
                        <input type="text" value="1" class="quantity-input" readonly>
                        <button class="quantity-btn btn-increase">+</button>
                    </div>
                    <div class="col-md-2 text-end">
                        <button class="btn-remove"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>

            <div class="cart-item mb-3" data-price="12.99">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=300&h=300&fit=crop" alt="Glow Mist Toner" class="img-fluid rounded">
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-1">Glow Mist Toner</h6>
                        <p class="text-muted mb-1">Thesara Cosmetics</p>
                        <p class="fw-semibold item-price">$12.99</p>
                    </div>
                    <div class="col-md-3 d-flex align-items-center justify-content-center">
                        <button class="quantity-btn btn-decrease">-</button>
                        <input type="text" value="2" class="quantity-input" readonly>
                        <button class="quantity-btn btn-increase">+</button>
                    </div>
                    <div class="col-md-2 text-end">
                        <button class="btn-remove"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>

            <div class="cart-item" data-price="29.99">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <img src="https://plus.unsplash.com/premium_photo-1661575474274-e84aecf9c464?q=80&w=774&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Radiance Night Cream" class="img-fluid rounded">
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-1">Radiance Night Cream</h6>
                        <p class="text-muted mb-1">Thesara Cosmetics</p>
                        <p class="fw-semibold item-price">$29.99</p>
                    </div>
                    <div class="col-md-3 d-flex align-items-center justify-content-center">
                        <button class="quantity-btn btn-decrease">-</button>
                        <input type="text" value="1" class="quantity-input" readonly>
                        <button class="quantity-btn btn-increase">+</button>
                    </div>
                    <div class="col-md-2 text-end">
                        <button class="btn-remove"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="col-lg-4">
            <div class="summary-box">
                <h5 class="fw-bold mb-3">Order Summary</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span> <span id="subtotal-amount">$0.00</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping</span> <span>$5.00</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                    <span>Total</span> <span id="total-amount">$0.00</span>
                </div>
                <a href="{{ route('checkout') }}" class="btn btn-dark w-100 py-2">
    <i class="fas fa-lock me-2"></i>Checkout
</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <!-- Cart specific JavaScript -->
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection