<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  // <-- ADD THIS IMPORT
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Temporarily disable foreign key checks for the entire seeding process
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            ProductsTableSeeder::class,
        ]);

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
            'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        Profile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'skin_type' => 'Combination',
                'concerns' => 'Dullness, uneven tone',
                'age' => 24,
            ]
        );

        // Seed a demo order (so you can immediately see Order History on the profile)
        if (!Order::where('user_id', $user->id)->exists()) {
            $productA = Product::where('category', 'serum')->first();
            $productB = Product::where('category', 'sunscreen')->first();

            if ($productA && $productB) {
                $items = [
                    ['product' => $productA, 'qty' => 1],
                    ['product' => $productB, 'qty' => 2],
                ];

                $total = collect($items)->sum(fn ($i) => $i['product']->price * $i['qty']);

                $order = Order::create([
                    'user_id' => $user->id,
                    'total' => $total,
                    'status' => 'delivered',
                    'address' => '347 Portobello, London',
                    'payment_method' => 'card',
                    'tracking_id' => 'TRK-' . now()->format('Ymd') . '-' . str_pad((string) $user->id, 4, '0', STR_PAD_LEFT),
                ]);

                DB::table('order_items')->insert([
                    [
                        'order_id' => $order->id,
                        'product_id' => $productA->id,
                        'quantity' => 1,
                        'price' => $productA->price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'order_id' => $order->id,
                        'product_id' => $productB->id,
                        'quantity' => 2,
                        'price' => $productB->price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);
            }
        }

        $this->call(AdminTableSeeder::class);

        // Re-enable foreign key checks after seeding is complete
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
