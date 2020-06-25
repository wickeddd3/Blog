<?php

use Illuminate\Database\Seeder;
use App\Category;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => 1,
            'name' => 'uncategorized',
            'slug' => 'uncategorized',
            'description' => 'uncategorized',
            'created_at' => Carbon::now()
        ]);
    }
}
