<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Faker as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::factory()->create([
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $user2 = User::factory()->create([
            'id' => 420,
            'name' => 'Dios Mio',
            'email' => 'dios@example.com',
            'password' => bcrypt('dios'),
        ]);

        Discussion::factory(5)->create([
            'author_id' => $user2->id,
        ]);

        Comment::factory(30)->create();
    }
}
