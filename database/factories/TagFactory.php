<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

$factory->define(Tag::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'name' => $name,
        'slug' => Str::slug($name, '-'),
        'created_at' => Carbon::now()
    ];
});
