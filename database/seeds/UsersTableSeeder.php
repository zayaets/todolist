<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'Susan Wheeler',
            'email' => 'susan_w@gmail.com',
            'password' => Hash::make('asdfasdf'),
        ]);

        $user2 = User::create([
            'name' => 'Michelle Obama',
            'email' => 'michelle_o@gmail.com',
            'password' => Hash::make('asdfasdf'),
        ]);
        $user3 = User::create([
            'name' => 'Jack Dorsey',
            'email' => 'jack_d@gmail.com',
            'password' => Hash::make('asdfasdf'),
        ]);
    }
}
