<?php

namespace Database\Factories;

use App\Models\Task;
use App\Enums\TaskStatusEnums;
use Illuminate\Database\Eloquent\Factories\Factory;


class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => TaskStatusEnums::PENDING->value
        ];
    }
}
