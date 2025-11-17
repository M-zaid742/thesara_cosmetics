@extends('layouts.app')

@section('title', 'Skincare Store – Home')

@section('content')
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
            <a href="{{ url('/shop') }}" class="btn btn-dark hero-btn">Shop Now</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="category-card shadow-sm">
          <img src="{{ asset('images/lip-serum.PNG') }}" alt="Lip Serum" class="category-img">
          <div class="category-content">
            <h5>Lip Serum</h5>
            <p class="text-muted">Elevate Your Natural Beauty</p>
            <a href="{{ url('/shop') }}" class="btn btn-dark hero-btn">Shop Now</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="category-card shadow-sm">
          <img src="{{ asset('images/sunscreen.png') }}" alt="Sunscreen" class="category-img">
          <div class="category-content">
            <h5>Sunscreen</h5>
            <p class="text-muted">Elevate Your Natural Beauty</p>
            <a href="{{ url('/shop') }}" class="btn btn-dark hero-btn">Shop Now</a>>
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
@endsection

@push('scripts')
  <script src="{{ asset('js/script.js') }}"></script>
@endpush
