<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'HydraGuard SPF 50',
                'subtitle' => 'Protect & nourish',
                'description' => 'Lightweight broad-spectrum SPF 50 protection with a non-greasy finish for daily use.',
                'price' => 27.00,
                'old_price' => 34.00,
                'stock' => 120,
                'category' => 'sunscreen',
                'brand' => 'Thesara',
                'badge' => 'Top Rated',
                'image_url' => 'images/seller4.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Vitamin Radiance Serum',
                'subtitle' => 'Brightening & glow',
                'description' => 'A brightening serum to help boost radiance and improve the look of uneven tone.',
                'price' => 27.00,
                'old_price' => 32.00,
                'stock' => 80,
                'category' => 'serum',
                'brand' => 'Thesara',
                'badge' => 'Save $5',
                'image_url' => 'images/seller2.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Hydra Balance Moisturizer',
                'subtitle' => 'Hydration boost',
                'description' => 'Daily moisturizer that supports a soft, hydrated feel without heaviness.',
                'price' => 25.00,
                'old_price' => 30.00,
                'stock' => 60,
                'category' => 'moisturizer',
                'brand' => 'Thesara',
                'badge' => 'New',
                'image_url' => 'images/seller3.png',
                'is_featured' => false,
            ],
            [
                'name' => 'Gentle Amino Cleanser',
                'subtitle' => 'Soft foam cleanse',
                'description' => 'A gentle cleanser that helps remove impurities while keeping skin comfortable.',
                'price' => 22.00,
                'old_price' => 29.00,
                'stock' => 100,
                'category' => 'cleanser',
                'brand' => 'Thesara',
                'badge' => 'Bestseller',
                'image_url' => 'images/seller1.png',
                'is_featured' => false,
            ],
            [
                'name' => 'Smooth AHA Exfoliator',
                'subtitle' => 'Refine texture',
                'description' => 'A gentle exfoliator to help improve the look of texture and dullness.',
                'price' => 19.00,
                'old_price' => 24.00,
                'stock' => 75,
                'category' => 'exfoliator',
                'brand' => 'Thesara',
                'badge' => null,
                'image_url' => 'images/seller5.png',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['name' => $productData['name']],
                $productData
            );
        }
    }
}
