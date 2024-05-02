<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' =>  'John Doe',
            'email' => 'john@example.com',
            'password' =>  bcrypt('password'),
        ]);

        User::factory()->create([
            'name' =>  'Jane Doe',
            'email' => 'jane@example.com',
            'password' =>  bcrypt('password'),
        ]);

        User::factory(10)->create();
        Message::factory(500)->create();
    }
}
