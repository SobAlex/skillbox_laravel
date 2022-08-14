<?php

namespace Database\Factories;

use App\Models\Step;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class StepFactory extends Factory
{
    protected $model = Step::class;

    public function definition()
    {
        return [
            'task_id' => Task::get()->random()->id,
            'description' => $this->faker->sentence(5),
        ];
    }
}
