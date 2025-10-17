<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Thesara Cosmetics</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Bootstrap CSS -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Thesara Cosmetics</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="/skin-analysis">Skin Analysis</a></li> <!-- Link to upload form -->
            <li class="nav-item"><a class="nav-link" href="/chatbot">Chatbot</a></li>
            @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}">Notifications</a></li>
                @if(auth()->user()->is_admin)
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
                @endif
                <li class="nav-item">
                    <form action="/logout" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-outline-danger">Logout</button>
                    </form>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
            @endauth
        </ul>
    </div>
</nav>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Bootstrap JS -->
</body>
</html>