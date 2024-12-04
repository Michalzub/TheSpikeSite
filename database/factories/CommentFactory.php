<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'discussion_id' => Discussion::all()->random()->id,
            'parent_id' => $this->faker->randomElement([null, Comment::factory()]),
            'author_id' => User::all()->random()->id,
            'text' => $this->faker->sentence(),

        ];
    }
}
