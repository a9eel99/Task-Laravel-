<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create users
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create posts
        $post1 = Post::create([
            'user_id' => $user1->id,
            'title' => 'My First Blog Post',
            'body' => 'This is the content of my first blog post. Laravel is amazing!',
        ]);

        $post2 = Post::create([
            'user_id' => $user2->id,
            'title' => 'Learning Laravel',
            'body' => 'Today I learned about Laravel policies and authorization. It\'s so powerful!',
        ]);

        // Create comments
        Comment::create([
            'post_id' => $post1->id,
            'user_id' => $user2->id,
            'body' => 'Great post! Thanks for sharing.',
        ]);

        Comment::create([
            'post_id' => $post2->id,
            'user_id' => $user1->id,
            'body' => 'Very informative, keep it up!',
        ]);
    }
}