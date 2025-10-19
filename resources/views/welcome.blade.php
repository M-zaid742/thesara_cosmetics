<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Skincare Store – Home</title>

  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Local Bootstrap (optional local copy) -->
  <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/splash.css') }}">
</head>
<body>

  <!-- Splash Screen Overlay -->
  <div id="splash-screen">
    <div class="splash-content">
      <img src="{{ asset('images/splashscreen.png') }}" alt="THESARA COSMETICS" class="splash-logo">
    </div>
  </div>

 <nav class="navbar navbar-expand-lg sticky-top reveal">
  <div class="container">
    <!-- Brand -->
    <a class="navbar-brand fw-bold text-uppercase" href="{{ url('/') }}">THESARA COSMETICS</a>

    <!-- Mobile Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
      aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse justify-content-center" id="navMenu">
      <ul class="navbar-nav gap-4 align-items-center">

        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/products') }}">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/faq') }}">FAQ</a></li>

        <!-- Dropdown beside FAQ -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">Shop</a>
          <ul class="dropdown-menu" aria-labelledby="shopDropdown">
            <li><a class="dropdown-item" href="{{ url('/orders/track') }}"><i class="bi bi-truck me-2"></i>Track Order</a></li>
            <li><a class="dropdown-item" href="{{ url('/orders') }}"><i class="bi bi-box-seam me-2"></i>Orders</a></li>
            <li><a class="dropdown-item" href="{{ url('/cart') }}"><i class="bi bi-bag me-2"></i>Cart</a></li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Profile Icon Dropdown -->
    <div class="dropdown">
      <a href="#" class="nav-icon dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="bi bi-person-circle fs-4"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
<<<<<<< HEAD
        <li><a class="dropdown-item" href="login.html"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a></li>
        <li><a class="dropdown-item" href="signup.html"><i class="bi bi-person-plus me-2"></i>Sign Up</a></li>
=======
        <li><a class="dropdown-item" href="{{ url('/login') }}"><i class="bi bi-bag me-2"></i>login</a></li>
        <a class="dropdown-item" href="{{ url('/register') }}"><i class="bi bi-bag me-2"></i>signup</a>
>>>>>>> 1d863428d7cb302c3ec3e7dea6ed709e7f259d02
      </ul>
    </div>
  </div>
</nav>


  <!-- HERO -->
  <section class="hero-section d-flex align-items-center reveal">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 hero-text">
          <span class="hero-tag">PREMIUM COSMETIC</span>
          <h1 class="hero-title">Reveal The <br> Beauty Of Skin</h1>
          <p class="hero-subtext">
            Elevate your natural beauty with our premium cosmetic products
            carefully curated to enhance your radiance.
          </p>
          <a href="{{ url('/shop') }}" class="btn btn-dark hero-btn">Explore Now</a>
        </div>
      </div>
    </div>

  </section>

  <!-- SHOP BY CATEGORY -->
  <section class="container section reveal" id="categories">
    <h3 class="section-title">Shop By Category</h3>
    <div class="row g-4">

      <div class="col-md-4">
        <div class="category-card shadow-sm">
          <img src="{{ asset('images/serum.PNG') }}" alt="Foundation Cream" class="category-img">
          <div class="category-content">
            <h5>Foundation Cream</h5>
            <p class="text-muted">Elevate Your Natural Beauty</p>
<<<<<<< HEAD
            <a href="{{ url('/shop') }}" class="btn btn-dark hero-btn">Shop Now</a>
=======
             <a href="{{ url('/shop') }}" class="btn btn-outline-dark">Shop Now</a>
>>>>>>> 1d863428d7cb302c3ec3e7dea6ed709e7f259d02
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="category-card shadow-sm">
          <img src="{{ asset('images/lip-serum.PNG') }}" alt="Lip Serum" class="category-img">
          <div class="category-content">
            <h5>Lip Serum</h5>
            <p class="text-muted">Elevate Your Natural Beauty</p>
<<<<<<< HEAD
             <a href="{{ url('/shop') }}" class="btn btn-dark hero-btn">Shop Now</a>
=======
            <a href="{{ url('/shop') }}" class="btn btn-outline-dark">Shop Now</a>
>>>>>>> 1d863428d7cb302c3ec3e7dea6ed709e7f259d02
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="category-card shadow-sm">
          <img src="{{ asset('images/sunscreen.png') }}" alt="Sunscreen" class="category-img">
          <div class="category-content">
            <h5>Sunscreen</h5>
            <p class="text-muted">Elevate Your Natural Beauty</p>
<<<<<<< HEAD
            <a href="{{ url('/shop') }}" class="btn btn-dark hero-btn">Shop Now</a>>
=======
            <a href="{{ url('/shop') }}" class="btn btn-outline-dark">Shop Now</a>
>>>>>>> 1d863428d7cb302c3ec3e7dea6ed709e7f259d02
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- BEST SELLERS -->
  <section class="container section reveal" id="best-sellers">
    <h3 class="section-title">Best Seller</h3>
    <div class="row g-4" id="product-list">

      @for ($i = 1; $i <= 8; $i++)
      <div class="col-6 col-md-3">
        <article class="product-card" data-id="{{ $i }}">
          <div class="product-thumb">
            <img src="{{ asset('images/seller'.$i.'.png') }}" alt="Product {{ $i }}">
          </div>
          <div class="product-body">
            <div class="small-muted">Gentle Cleanser</div>
            <div class="fw-semibold">CeraMo Amino Cleanser</div>
            <div class="rating small">
              ⭐⭐⭐⭐☆ <span class="text-muted">(129 Reviews)</span>
            </div>
            <div class="price">$22.00 <del>$29.00</del> <span class="text-primary">-20%</span></div>
            <div class="delivery">🚚 Free delivery</div>
          </div>
          <div class="card-actions">
            <div class="qty-control">
              <button class="btn btn-outline-dark btn-sm btn-decrease">-</button>
              <span class="qty px-2">1</span>
              <button class="btn btn-outline-dark btn-sm btn-increase">+</button>
            </div>
            <button class="btn btn-dark btn-cart"><i class="bi bi-bag me-1"></i>Add to Cart</button>
          </div>
        </article>
      </div>
      @endfor

    </div>
  </section>

  <!-- NEW COLLECTION -->
  <section class="container section reveal">
    <h3 class="section-title">New Collection</h3>
    <div class="collection-banner">
      <img src="{{ asset('images/collection.png') }}" alt="New Collection" />
      <div class="banner-overlay">
       <a href="{{ url('/shop') }}" class="btn btn-dark hero-btn">Explore Now</a>
      </div>
    </div>
  </section>

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
  <!-- Local Bootstrap (optional local copy) -->
  <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
<<<<<<< HEAD
=======
  <!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> 1d863428d7cb302c3ec3e7dea6ed709e7f259d02

  <!-- Custom JS -->
  <script src="{{ asset('js/script.js') }}"></script>
  <script src="{{ asset('js/splash.js') }}"></script>
</body>
</html>
