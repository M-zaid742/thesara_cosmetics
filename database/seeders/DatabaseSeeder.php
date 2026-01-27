<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  // <-- ADD THIS IMPORT

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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(AdminTableSeeder::class);

        // Re-enable foreign key checks after seeding is complete
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}