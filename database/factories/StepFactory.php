<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Step;
use App\Task;

class StepFactory extends Factory
{
    protected $model = Step::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_id' => Task::get()->random()->id,
            'description' => $this->faker->sentence(5),
        ];
    }
}
