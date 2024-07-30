<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->word(2),
            'description' => $this->faker->text(),
            'completed' => rand(0, 1),
            'project_id' => rand(1, 5),
            'user_id' => rand(1, 5),
        ];
    }
}
