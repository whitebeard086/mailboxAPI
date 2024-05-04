<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $receiverId = 1;
        $senderId = $this->faker->randomElement(User::where('id', '!=', 1)->pluck('id')->toArray());

        return [
            'receiver_id' => $receiverId,
            'sender_id' => $senderId,
            'subject' => $this->faker->realText(30),
            'content' => $this->faker->realText(800),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
