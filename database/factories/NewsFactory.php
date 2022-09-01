<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => User::get()->random()->id,
            'title' => $this->faker->text(10),
            'image' => '2.jpg',
            'content' => $this->faker->text(500),
            'isPublick' => 1,
        ];
    }
}
