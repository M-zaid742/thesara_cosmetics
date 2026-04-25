@extends('admin.layout.layout')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold" style="color: #3b2c20;">Edit Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card card-outline shadow-lg" style="border-top: 3px solid #d4a017;">
                        <div class="card-header bg-white">
                            <h3 class="card-title text-uppercase font-weight-bold">Update details: {{ $category->name }}</h3>
                        </div>
                        
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $category->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="image">Category Image</label>
                                    @if($category->image_url)
                                        <div class="mb-3 text-center">
                                            <p class="small text-muted mb-2">Current Image:</p>
                                            <img src="{{ asset($category->image_url) }}" alt="Current Image" style="max-width: 150px; border-radius: 8px; border: 1px solid #ddd;">
                                        </div>
                                    @endif
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="image" onchange="previewImage(this)">
                                            <label class="custom-file-label" for="image">Choose new image...</label>
                                        </div>
                                    </div>
                                    <div id="image-preview" class="mt-3 text-center" style="display: none;">
                                        <img id="preview" src="#" alt="Preview" style="max-width: 200px; border-radius: 12px; border: 2px solid #d4a017;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-white border-top">
                                <button type="submit" class="btn btn-lg px-5 font-weight-bold text-uppercase" style="background: #1a1208; color: #d4a017; border-radius: 50px;">
                                    <i class="fas fa-check-circle mr-2"></i> Update Category
                                </button>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-lg btn-link text-muted">Cancel</a>
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
            document.getElementById('preview').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
        input.nextElementSibling.innerText = input.files[0].name;
    }
}
</script>
@endsection
