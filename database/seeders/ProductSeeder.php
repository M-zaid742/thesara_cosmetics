<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Sun Screen',
                'subtitle' => 'For all skin types',
                'category' => 'sunscreen',
                'price' => 22.00,
                'old_price' => 29.00,
                'badge' => 'Bestseller',
                'image_url' => 'images/seller1.png',
                'is_featured' => true,
                'description' => 'Premium sun protection for all skin types.',
                'stock' => 100,
                'brand' => 'Thesara',
            ],
            [
                'name' => 'Vitamin Radiance Serum',
                'subtitle' => 'Brightening & glow',
                'category' => 'serum',
                'price' => 27.00,
                'old_price' => 32.00,
                'badge' => 'Save $5',
                'image_url' => 'images/seller2.png',
                'is_featured' => true,
                'description' => 'Brightening serum for a radiant glow.',
                'stock' => 80,
                'brand' => 'Thesara',
            ],
            [
                'name' => 'Hydra Balance Moisturizer',
                'subtitle' => 'Hydration boost',
                'category' => 'moisturizer',
                'price' => 25.00,
                'old_price' => 30.00,
                'badge' => 'New',
                'image_url' => 'images/seller3.png',
                'is_featured' => true,
                'description' => 'Deep hydration moisturizer for all day moisture.',
                'stock' => 60,
                'brand' => 'Thesara',
            ],
            [
                'name' => 'HydraGuard SPF 50',
                'subtitle' => 'Protect & nourish',
                'category' => 'sunscreen',
                'price' => 27.00,
                'old_price' => 34.00,
                'badge' => 'Top Rated',
                'image_url' => 'images/seller4.png',
                'is_featured' => true,
                'description' => 'High protection SPF 50 sunscreen.',
                'stock' => 90,
                'brand' => 'Thesara',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}