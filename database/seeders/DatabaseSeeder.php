<?php

namespace Database\Seeders;

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
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            TagSeeder::class,
            NewsSeeder::class,
            TaskSeeder::class,
            StepSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
