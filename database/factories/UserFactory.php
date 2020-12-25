<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName($gender = 'male'|'female'),
        'last_name' => $faker->lastName,
        'role' => $faker->randomElement($array = array('administrator', 'subscriber', 'writer', 'editor', 'moderator')),
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'created_at' => Carbon::now()
    ];
});
