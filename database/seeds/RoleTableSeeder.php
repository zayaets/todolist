<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Role::create([
            'name' => 'User',
            'slug' => 'user',
        ]);
        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);
    }
}
