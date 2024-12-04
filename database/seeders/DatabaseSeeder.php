<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\Note;
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
        $user = User::factory()->create([
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $discussions = Discussion::factory(20)->create([
            'author_id' => $user->id,
        ]);

        Comment::factory(30)->create([
            'author_id' => $user->id,
            'discussion_id' => $discussions->random()->id,
        ]);
    }
}
