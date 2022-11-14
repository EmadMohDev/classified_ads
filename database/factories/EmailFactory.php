<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->sentence(15),
            'body' => $this->faker->paragraph(5),
            'to' => User::first()->email,
            'cc' => User::inRandomOrder()->first()->email,
            'notifier_id' => 1
        ];
    }
}
