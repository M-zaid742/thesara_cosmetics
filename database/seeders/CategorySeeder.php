<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Cleanser', 'image' => 'images/seller1.png'],
            ['name' => 'Serum', 'image' => 'images/serum.PNG'],
            ['name' => 'Moisturizer', 'image' => 'images/seller2.png'],
            ['name' => 'Sunscreen', 'image' => 'images/seller3.png'],
            ['name' => 'Exfoliator', 'image' => 'images/seller4.png'],
            ['name' => 'Toner', 'image' => 'images/seller5.png'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'image_url' => $cat['image']
                ]
            );
        }
    }
}
