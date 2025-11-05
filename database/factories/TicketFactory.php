<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TicketStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'body' => $this->faker->sentence,
            'status' => TicketStatus::PENDING->value,
            'user_id' => rand(1, User::count()),
            'assigned_to' => rand(1, User::count()),
        ];
    }
}
