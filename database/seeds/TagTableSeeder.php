<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'name' => 'MVC',
                'slug' => 'mvc',
                'description' => 'code architecture',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'SOLID',
                'slug' => 'solid',
                'description' => 'code pattern',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'BEM',
                'slug' => 'bem',
                'description' => 'code pattern',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'SPA',
                'slug' => 'spa',
                'description' => 'web application type',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'SSR',
                'slug' => 'ssr',
                'description' => 'Server Side Rendering',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Component',
                'slug' => 'component',
                'description' => 'component',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Slot',
                'slug' => 'slot',
                'description' => 'slot',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Props',
                'slug' => 'props',
                'description' => 'props',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Vuex',
                'slug' => 'vuex',
                'description' => 'State Management',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Redux',
                'slug' => 'redux',
                'description' => 'State Management',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'VueRouter',
                'slug' => 'vuerouter',
                'description' => 'Official router of vue.js',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'ReactRouter',
                'slug' => 'reactrouter',
                'description' => 'Official router of React',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
