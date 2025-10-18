<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Thesara Cosmetics')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Navbar Styles */
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
                    <li class="nav-item"><a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="{{ url('/products') }}">Products</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ url('/faq') }}">FAQ</a></li>

                    <!-- Dropdown for Orders, Cart -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Shop
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="shopDropdown">
                            <li><a class="dropdown-item" href="{{ url('/orders') }}">My Orders</a></li>
                            <li><a class="dropdown-item" href="{{ url('/orders/track') }}">Track Order</a></li>
                            <li><a class="dropdown-item" href="{{ url('/cart') }}">Cart</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Profile Button -->
                <div class="dropdown">
                    <i class="bi bi-person-circle profile-icon dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown"></i>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ url('/login') }}">Login</a></li>
                        <li><a class="dropdown-item" href="{{ url('/signup') }}">Sign Up</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
