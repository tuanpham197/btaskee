<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            // ServiceSeeder::class,
            ServiceDetailSeeder::class
        ]);
        // User::factory()->count(1)->create();
    }
}
