<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
        $status = ["Not Started", "Ongoing", "Completed"];
        $date = fake()->date("Y-m-d") . " " . fake()->time();

        return [
            "title" => fake()->realText($maxNbChars = 50),
            "description" => fake()->text(),
            "status" => fake()->randomElement($status),
            "user_id" => fake()->randomElement(User::pluck("id")),
            "created_at" => $date,
            "updated_at" => $date
        ];
    }
}
