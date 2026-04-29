@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold" style="color: #3b2c20;">Add New Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline shadow-lg" style="border-top: 3px solid #d4a017;">
                        <div class="card-header bg-white">
                            <h3 class="card-title text-uppercase font-weight-bold" style="letter-spacing: 1px;">Product Details</h3>
                        </div>
                        
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <!-- Basic Info -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="e.g. Vitamin C Radiance Serum" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subtitle">Subtitle</label>
                                            <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="e.g. Brightening & glow">
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" class="form-control" id="category_id">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" class="form-control" id="description" rows="4" placeholder="Detailed product description..."></textarea>
                                        </div>
                                    </div>

                                    <!-- Pricing and Inventory -->
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price">Sale Price (Rs.) <span class="text-danger">*</span></label>
                                                    <input type="number" name="price" class="form-control" id="price" placeholder="0.00" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="old_price">Original Price (Rs.)</label>
                                                    <input type="number" name="old_price" class="form-control" id="old_price" placeholder="0.00">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cost_price">Cost Price (Rs.)</label>
                                                    <input type="number" name="cost_price" class="form-control" id="cost_price" placeholder="0.00">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="stock">Inventory Stock</label>
                                                    <input type="number" name="stock" class="form-control" id="stock" placeholder="0">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="badge">Product Badge</label>
                                            <input type="text" name="badge" class="form-control" id="badge" placeholder="e.g. New, Bestseller, -20%">
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Featured Image <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="image" id="image" required onchange="previewImage(this)">
                                                    <label class="custom-file-label" for="image">Choose main image</label>
                                                </div>
                                            </div>
                                            <div id="image-preview" class="mt-2 text-center" style="display: none;">
                                                <img id="preview" src="#" alt="Preview" style="max-width: 150px; border-radius: 8px; border: 2px solid #d4a017;">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="related_images">Related Images (Gallery)</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="related_images[]" id="related_images" multiple onchange="previewMultipleImages(this)">
                                                    <label class="custom-file-label" for="related_images">Choose multiple images</label>
                                                </div>
                                            </div>
                                            <div id="related-images-preview" class="mt-2 d-flex flex-wrap gap-2">
                                                <!-- Previews will appear here -->
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured">
                                                <label class="custom-control-label font-weight-bold" for="is_featured">Feature this product on homepage</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ingredients">Ingredients List</label>
                                            <textarea name="ingredients" class="form-control" id="ingredients" rows="3" placeholder="Aqua, Glycerin, Sodium Hyaluronate..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-white border-top">
                                <button type="submit" class="btn btn-lg px-5 font-weight-bold text-uppercase" style="background: #1a1208; color: #d4a017; border-radius: 50px;">
                                    <i class="fas fa-plus-circle mr-2"></i> Create Product
                                </button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-lg btn-link text-muted">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
            $('#image-preview').show();
        }
        reader.readAsDataURL(input.files[0]);
        $(input).next('.custom-file-label').html(input.files[0].name);
    }
}

function previewMultipleImages(input) {
    const previewContainer = $('#related-images-preview');
    previewContainer.empty();
    
    if (input.files) {
        const filesAmount = input.files.length;
        for (i = 0; i < filesAmount; i++) {
            const reader = new FileReader();
            reader.onload = function(event) {
                $($.parseHTML('<img>'))
                    .attr('src', event.target.result)
                    .css({
                        'max-width': '80px',
                        'height': '80px',
                        'object-fit': 'cover',
                        'border-radius': '6px',
                        'border': '1px solid #ddd'
                    })
                    .appendTo(previewContainer);
            }
            reader.readAsDataURL(input.files[i]);
        }
        $(input).next('.custom-file-label').html(filesAmount + ' files selected');
    }
}
</script>
@endsection