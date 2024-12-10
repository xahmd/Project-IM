<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_types')->insert([
            [
                'name' => 'Sick Leave',
                'limit' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Annual Leave',
                'limit' => '20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maternity Leave',
                'limit' => '90',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paternity Leave',
                'limit' => '7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Unpaid Leave',
                'limit' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
