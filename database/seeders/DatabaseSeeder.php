<?php

namespace Database\Seeders;

use Database\Seeders\PostSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();

        // User::factory()
        //     ->count(50)
        //     ->hasPosts(1)
        //     ->create();

        // $this->call([
        // UserSeeder::class,
        // PostSeeder::class,
        // ]);
    }
}
