<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('users')->insert([

            [
                'name' => 'John Due',
                'department_id' => '1',
                'designation_id' => '1',
                'mobile' => '8887847484',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Tommy Mark',
                'department_id' => '2',
                'designation_id' => '2',
                'mobile' => '8887333484',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'John Due',
                'department_id' => '1',
                'designation_id' => '1',
                'mobile' => '8327847484',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Tommy Mark',
                'department_id' => '2',
                'designation_id' => '2',
                'mobile' => '8885327484',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
