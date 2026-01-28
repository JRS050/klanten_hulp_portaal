<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'username' => 'Admin',
            'name' => 'Jon',
            'surname' => 'User',
            'telephone_number' => '1234567890',
            'email' => 'admin@example.com',
            'password' => 'test',
            'admin_status' => true
            ],
        );
        User::factory()->create([
            'username' => 'Admin2',
            'name' => 'Marco',
            'surname' => 'Rossi',
            'telephone_number' => '0987654321',
            'email' => 'admin2@example.com',
            'password' => 'test',
            'admin_status' => true
            ],
        );
        User::factory()->create([
            'username' => 'User',
            'name' => 'Paola',
            'surname' => 'Marti',
            'telephone_number' => '5555555555',
            'email' => 'user@example.com',
            'password' => 'test',
            'admin_status' => false
            ],
        );
        User::factory(7)->create();

        Category::factory(5)->create();

        Ticket::factory(10)->create()->each(function ($ticket) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $ticket->categories()->attach($categories);
        });

        
    }
}
