<?php

namespace Database\Seeders;

use Database\Seeders\UserSeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\TaskSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\ContactSeeder;
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
            // TagSeeder::class,
            TaskSeeder::class,
            StepSeeder::class,
            ContactSeeder::class,
        ]);
    }
}
