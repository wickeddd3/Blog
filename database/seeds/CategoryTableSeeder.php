<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'PHP Framework',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Node.js',
                'slug' => 'nodejs',
                'description' => 'Javascript Runtime Environment',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vuejs',
                'description' => 'Javascript Framework',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'React.js',
                'slug' => 'reactjs',
                'description' => 'Javascript Library',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Angular',
                'slug' => 'angular',
                'description' => 'Javascript Framework',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
