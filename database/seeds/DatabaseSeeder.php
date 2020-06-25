<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Tag;
use App\Post;
use App\User;

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
            CategoriesTableSeeder::class,
            UsersTableSeeder::class,
        ]);

        factory(User::class, 9)->create();
        factory(Category::class, 10)->create();
        factory(Tag::class, 20)->create();
        factory(Post::class, 100)->create();

        // Get all tags
        $tags = App\Tag::all();

        // Populate the pivot table
        App\Post::all()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });

    }
}
