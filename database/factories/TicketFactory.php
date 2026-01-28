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
         $user = User::where('admin_status', false)->inRandomOrder()->first();

        // Get a random user with admin_status true
        $adminUser = User::where('admin_status', true)->inRandomOrder()->first();

        return [
            'title' => $this->faker->word,
            'body' => $this->faker->sentence,
            'status' => TicketStatus::PENDING->value,
            'user_id' => $user->id,
            'assigned_to' => $adminUser->id,
        ];
    }
}
