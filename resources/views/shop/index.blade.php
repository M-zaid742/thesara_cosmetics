@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Thesara Cosmetics</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- head section in layouts/app.blade.php (or the cart view) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- your custom css (use asset helper) -->
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

</head>
<body>




    <!-- Main Content -->
    <div class="container py-5">
        <h2 class="fw-bold mb-4">Your Shopping Cart</h2>

        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-item mb-3" data-price="17.50">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <img src="https://picsum.photos/120/120?random=1" alt="Hydragaurd SPF 50 Sunscreen" class="img-fluid rounded">
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
                            <img src="https://picsum.photos/120/120?random=2" alt="Glow Mist Toner" class="img-fluid rounded">
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
                            <img src="https://picsum.photos/120/120?random=3" alt="Radiance Night Cream" class="img-fluid rounded">
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
                    <button class="btn btn-dark w-100 py-2"><i class="fas fa-lock me-2"></i>Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-4 text-md-start text-center mb-4 mb-md-0">
                    <h4 class="footer-logo">THESARA COSMETICS</h4>
                    <p class="tagline">Elevate your natural beauty</p>
                </div>
                <div class="col-md-8 text-md-end text-center">
                    <h5 class="subscribe-title">Subscribe To Get 15% Off</h5>
                    <form class="subscribe-form">
                        <input type="email" placeholder="Please enter your email" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>

            <div class="row mt-4 text-center text-md-start">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h6>Resources</h6>
                    <ul>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Free Demo</a></li>
                        <li><a href="#">Press Conference</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4 mb-md-0">
                    <h6>Legal</h6>
                    <ul>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Cookies Policy</a></li>
                        <li><a href="#">Data Processing</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h6>Contact</h6>
                    <p>070 7774 1690</p>
                    <p>347 Portobello, London</p>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom mt-4">
                <p>© THESARA COSMETICS 2025 All rights reserved.</p>
                <div class="contact-info">
                    <span><i class="bi bi-envelope"></i> info@thesara.com</span>
                    <span><i class="bi bi-telephone"></i> +1234-456-7890</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- bottom of layout/app.blade.php or cart view -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- your custom js -->
<script src="{{ asset('js/cart.js') }}"></script>


</body>
</html>
@endsection
