<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Wicked',
            'last_name' => 'Wicked',
            'username' => 'wicked123',
            'email' => 'wicked@wicked.com',
            'password' => Hash::make('password'),
            'role' => 'administrator',
            'email_verified_at' => now(),
            'created_at' => Carbon::now()
        ]);
    }
}
