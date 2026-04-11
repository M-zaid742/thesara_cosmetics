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
          <a href="{{ route('shop') }}" class="btn btn-dark hero-btn">Explore Now</a>
        </div>
      </div>
    </div>
  </section>

  <!-- SHOP BY CATEGORY -->
  <section class="container section reveal" id="categories">
    <h3 class="section-title">Shop By Category</h3>
    @php
      $categorySlides = collect($categories ?? [])->chunk(3);
    @endphp

    @if($categorySlides->isEmpty())
      <p class="text-muted mb-0">No categories available right now.</p>
    @else
      <div id="categoryCarousel" class="carousel slide">
        <div class="carousel-inner">
          @foreach($categorySlides as $slideIndex => $slide)
            <div class="carousel-item {{ $slideIndex === 0 ? 'active' : '' }}">
              <div class="row g-4 justify-content-center">
                @foreach($slide as $category)
                  <div class="col-12 col-md-4">
                    <div class="home-category-card">
                      <img
                        src="{{ asset($category['image_path'] ?: 'images/seller1.png') }}"
                        alt="{{ $category['name'] }}"
                        class="home-category-img"
                        loading="lazy"
                      >
                      <div class="home-category-content">
                        <a href="{{ route('products.category', ['category' => $category['name']]) }}" class="btn">Shop Now</a>
                      </div>
                    </div>
                    <div class="mt-2 text-center">
                      <div class="fw-semibold">{{ $category['name'] }}</div>
                      <div class="small text-muted">{{ $category['count'] }} product{{ $category['count'] === 1 ? '' : 's' }}</div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    @endif
  </section>

  <!-- BEST SELLERS -->
  <section class="container section reveal" id="best-sellers">
    <h3 class="section-title">Best Seller</h3>
    <div class="row g-4" id="product-list">
      @forelse ($featuredProducts as $product)
      <div class="col-6 col-md-3">
        <article class="product-card" data-id="{{ $product->id }}">
          <div class="product-thumb">
            <a href="{{ route('product.show', $product->id) }}">
              <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}">
            </a>
          </div>
          <div class="product-body">
            <div class="small-muted">{{ $product->category }}</div>
            <div class="fw-semibold">{{ $product->name }}</div>
            <div class="rating small">
              ⭐⭐⭐⭐☆ <span class="text-muted">({{ $product->reviews_count ?? 0 }} Reviews)</span>
            </div>
            <div class="price">
                ${{ number_format($product->price, 2) }} 
                @if($product->old_price)
                    <del>${{ number_format($product->old_price, 2) }}</del> 
                    <span class="text-primary">-{{ round((($product->old_price - $product->price) / $product->old_price) * 100) }}%</span>
                @endif
            </div>
            <div class="delivery">🚚 Free delivery</div>
          </div>
          <div class="card-actions">
            <form action="{{ route('cart.add') }}" method="POST" class="w-100 d-flex gap-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-dark btn-cart flex-grow-1"><i class="bi bi-bag me-1"></i>Add to Cart</button>
            </form>
          </div>
        </article>
      </div>
      @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">No featured products available at the moment.</p>
        </div>
      @endforelse
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

  <!-- FLOATING DERMAI BUTTON -->
  <style>
    .floating-dermai-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      z-index: 1000;
      background-color: #212529;
      color: #fff;
      padding: 12px 24px;
      border-radius: 50px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      text-decoration: none;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
    }
    .floating-dermai-btn:hover {
      background-color: #343a40;
      color: #fff;
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.25);
    }
    .floating-dermai-btn i {
      font-size: 1.2rem;
      /* If Bootstrap Icons (bi) is loaded. We'll use bi-stars or bi-robot */
    }
  </style>
  <a href="{{ route('dermai.chat') }}" class="floating-dermai-btn">
    <i class="bi bi-robot"></i> Try DermAI
  </a>
@endsection

@push('scripts')
  <script src="{{ asset('js/script.js') }}"></script>
@endpush
