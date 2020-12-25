<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            CategoryTableSeeder::class,
            TagTableSeeder::class,
        ]);

        factory(User::class, 9)->create();
        factory(Post::class, 100)->create();

        // Get all tags
        $tags = Tag::all();

        // Populate the pivot table
        Post::all()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });

    }
}
