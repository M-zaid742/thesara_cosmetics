<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id' => 1,
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
        ]);
    }
}
