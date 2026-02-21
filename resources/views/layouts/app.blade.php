<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Thesara Cosmetics')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Font Awesome (for cart icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS (public/css/) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Page specific styles -->
    @yield('styles')

    <style>
        /* Navbar Styles (original solid bar) */
        .navbar {
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,.06);
        }
        .navbar .nav-link {
            color: #3b2c20;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
            padding-bottom: 4px;
        }
        .navbar .nav-link:hover {
            color: #7a5c3c;
        }
        .navbar .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2px;
            background-color: #7a5c3c;
            transition: width 0.3s ease-in-out;
        }
        .navbar .nav-link:hover::after,
        .navbar .nav-link.active::after {
            width: 100%;
        }

        /* Dropdown menu */
        .dropdown-menu {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Profile icon */
        .profile-icon {
            font-size: 22px;
            cursor: pointer;
            color: #3b2c20;
            transition: color 0.3s ease;
        }
        .profile-icon:hover {
            color: #7a5c3c;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-uppercase" href="{{ url('/') }}">THESARA COSMETICS</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto gap-3">
                    <li class="nav-item"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('shop') ? 'active' : '' }}" href="{{ route('shop') }}">Products</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ url('/faq') }}">FAQ</a></li>

                    <!-- Dropdown for Orders, Cart -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Shop
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="shopDropdown">
                            <li><a class="dropdown-item" href="{{ url('/orders') }}">My Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('track.order') }}">Track Order</a></li>
                            <li><a class="dropdown-item" href="{{ route('cart.index') }}">Cart</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Profile Button -->
                <div class="dropdown">
                    <i class="bi bi-person-circle profile-icon dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown"></i>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        @auth
                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}">My Account</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ url('/login') }}">Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Sign Up</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-4">
                    <h4 class="footer-logo">THESARA COSMETICS</h4>
                    <p class="tagline">Elevate your natural beauty</p>
                </div>
                <div class="col-md-8">
                    <h5 class="subscribe-title">Subscribe To Get 15% Off</h5>
                    <form class="subscribe-form">
                        <input type="email" placeholder="Please enter your email" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <h6>Resources</h6>
                    <ul>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Free Demo</a></li>
                        <li><a href="#">Press Conference</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Page specific scripts -->
    @yield('scripts')
    @stack('scripts')
</body>
</html>