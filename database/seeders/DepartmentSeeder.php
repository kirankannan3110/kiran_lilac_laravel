<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('department')->insert([

            [
                'name' => 'Sales and marketing',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Application development',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
