<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'post_type' => $this->faker->randomElement(['discussion', 'comment']),
            'post_id' => $this->faker->randomElement([Discussion::factory(), Comment::factory()]),
            'vote_type' => $this->faker->boolean(),
        ];
    }
}
