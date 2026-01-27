<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Temporarily disable foreign key checks to allow truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear the table (this will now work even with foreign key constraints)
        Product::truncate();

        // Re-enable foreign key checks after we're done
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert product(s)
        DB::table('products')->insert([
            [
                'name' => 'Hydraguard SPF 50 Sunscreen',
                'description' => 'A lightweight, non-greasy sunscreen formulated for oily and combination skin. Provides broad-spectrum UVA/UVB protection with SPF 50, helps control shine, and keeps skin hydrated with hyaluronic acid.',
                'price' => 1750.00,
                'stock' => 100,
                'category' => 'Sun Protection',
                'brand' => 'Thesara Cosmetics',
                'image_url' => 'sunscreen/product1/product1.png',
                'created_at' => Carbon::parse('2025-10-23 10:55:44'),
                'updated_at' => Carbon::parse('2025-10-23 10:55:44'),
            ]
            // Add more products here if needed
        ]);
    }
}