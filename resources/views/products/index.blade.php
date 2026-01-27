@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Browse Products</h1>
    
    <!-- Search and Filter Form (FR-4) -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search by product name" value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    <!-- Add dynamic categories if needed; for now, static examples from SRS (e.g., moisturizer, acne) -->
                    <option value="moisturizer" {{ request('category') == 'moisturizer' ? 'selected' : '' }}>Moisturizer</option>
                    <option value="acne" {{ request('category') == 'acne' ? 'selected' : '' }}>Acne Treatment</option>
                    <!-- Add more based on your products table -->
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Product List (UC-5) -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                        <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                        <p class="card-text"><strong>Category:</strong> {{ $product->category }}</p>
                        <p class="card-text"><strong>Brand:</strong> {{ $product->brand }}</p>
                        <!-- Add to Cart/Wishlist Forms (FR-5) -->
                        <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-success btn-sm">Add to Cart</button>
                        </form>
                        <form action="{{ route('wishlist.add') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-info btn-sm">Add to Wishlist</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    {{ $products->links() }}
</div>
@endsection