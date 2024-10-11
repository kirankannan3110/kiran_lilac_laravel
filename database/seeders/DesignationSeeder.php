<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('designation')->insert([

            [
                'name' => 'Marketing Manager',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Mobile Application Dev.',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
