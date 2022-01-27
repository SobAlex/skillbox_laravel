<?php

namespace Database\Factories;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'owner_id' => User::get()->random()->id,
            'code' => $this->faker->word(),
            'title' => $this->faker->text(10),
            'shortContent' => $this->faker->sentence(10),
            'content' => $this->faker->text(500),
            'isPublick' => 1,
        ];
    }
}
