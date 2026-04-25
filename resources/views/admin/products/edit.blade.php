@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold" style="color: #3b2c20;">Edit Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline shadow-lg" style="border-top: 3px solid #d4a017;">
                        <div class="card-header bg-white">
                            <h3 class="card-title text-uppercase font-weight-bold" style="letter-spacing:1px;">
                                Editing: {{ $product->name }}
                            </h3>
                        </div>

                        <form action="{{ route('admin.products.update', $product->id) }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <div class="row">

                                    {{-- Basic Info --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                   value="{{ old('name', $product->name) }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subtitle">Subtitle</label>
                                            <input type="text" name="subtitle" class="form-control" id="subtitle"
                                                   value="{{ old('subtitle', $product->subtitle) }}"
                                                   placeholder="e.g. Brightening & glow">
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" class="form-control" id="category_id">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" id="description"
                                                      rows="4">{{ old('description', $product->description) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="ingredients">Ingredients List</label>
                                            <textarea name="ingredients" class="form-control" id="ingredients"
                                                      rows="3">{{ old('ingredients', $product->ingredients) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- Pricing, Inventory, Image --}}
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price">Sale Price (Rs.) <span class="text-danger">*</span></label>
                                                    <input type="number" name="price" class="form-control" id="price"
                                                           value="{{ old('price', $product->price) }}" step="0.01" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="old_price">Original Price (Rs.)</label>
                                                    <input type="number" name="old_price" class="form-control" id="old_price"
                                                           value="{{ old('old_price', $product->old_price) }}" step="0.01">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cost_price">Cost Price (Rs.)</label>
                                                    <input type="number" name="cost_price" class="form-control" id="cost_price"
                                                           value="{{ old('cost_price', $product->cost_price) }}" step="0.01">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="stock">Stock</label>
                                                    <input type="number" name="stock" class="form-control" id="stock"
                                                           value="{{ old('stock', $product->stock) }}" min="0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="badge">Product Badge</label>
                                            <input type="text" name="badge" class="form-control" id="badge"
                                                   value="{{ old('badge', $product->badge) }}"
                                                   placeholder="e.g. New, Bestseller, -20%">
                                        </div>

                                        {{-- Current Image + Upload --}}
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            @if($product->image_url)
                                            <div class="mb-2">
                                                <p class="text-muted small mb-1">Current image:</p>
                                                <img id="preview"
                                                     src="{{ asset($product->image_url) }}"
                                                     alt="{{ $product->name }}"
                                                     style="max-width:130px;border-radius:10px;border:2px solid #d4a017;">
                                            </div>
                                            @else
                                                <img id="preview" src="#" alt="Preview"
                                                     style="display:none;max-width:130px;border-radius:10px;border:2px solid #d4a017;">
                                            @endif
                                            <div class="input-group mt-1">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="image"
                                                           onchange="updatePreview(this)">
                                                    <label class="custom-file-label" for="image">Replace image (optional)</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" class="custom-control-input" id="is_featured"
                                                       name="is_featured"
                                                       {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                                <label class="custom-control-label font-weight-bold" for="is_featured">
                                                    Feature this product on homepage
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white border-top">
                                <button type="submit" class="btn btn-lg px-5 font-weight-bold text-uppercase"
                                        style="background:#1a1208;color:#d4a017;border-radius:50px;">
                                    <i class="fas fa-save mr-2"></i> Save Changes
                                </button>
                                <a href="{{ route('admin.products.index') }}"
                                   class="btn btn-lg btn-link text-muted">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function updatePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById('preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
        $(input).next('.custom-file-label').html(input.files[0].name);
    }
}
</script>
@endsection
