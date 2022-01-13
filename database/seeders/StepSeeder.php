<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Step;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Step::factory()->count(7)->create();
    }
}
