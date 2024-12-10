<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'firstName' => 'User',
            'lastName' => 'Test',
            'email' => 'test@test.com',
            'staffID' => 'User123',
        'role' => 'Admin',
            'password' => Hash::make('password'),
        ]);
    }
}
