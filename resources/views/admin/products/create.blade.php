<!-- resources/views/admin/add-product.blade.php -->
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f8;
        padding: 20px;
    }

    .product-form-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .product-form-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .product-form-container input[type="text"],
    .product-form-container input[type="number"],
    .product-form-container textarea,
    .product-form-container input[type="file"] {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        transition: border 0.3s;
    }

    .product-form-container input[type="text"]:focus,
    .product-form-container input[type="number"]:focus,
    .product-form-container textarea:focus,
    .product-form-container input[type="file"]:focus {
        border-color: #007bff;
        outline: none;
    }

    .product-form-container label {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-weight: 500;
    }

    .product-form-container label input[type="checkbox"] {
        margin-left: 10px;
        width: 18px;
        height: 18px;
    }

    .product-form-container button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .product-form-container button:hover {
        background-color: #0056b3;
    }
</style>

<div class="product-form-container">
    <h2>Add New Product</h2>
    <form action="/admin/products/store" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="subtitle" placeholder="Subtitle">
        <textarea name="description" placeholder="Description" rows="4"></textarea>
        <input type="number" name="price" placeholder="Price" required>
        <input type="number" name="cost_price" placeholder="Cost Price">
        <input type="number" name="old_price" placeholder="Old Price">
        <input type="number" name="stock" placeholder="Stock">
        <input type="text" name="category" placeholder="Category">
        <input type="text" name="badge" placeholder="Badge">

        <label>
            Featured:
            <input type="checkbox" name="is_featured">
        </label>

        <input type="file" name="image" required>

        <button type="submit">Add Product</button>
    </form>
</div>