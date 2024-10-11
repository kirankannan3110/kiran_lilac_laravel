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

        $array = array(
            array(
                'name'              => 'Admin',
                'email'             => 'admin@gistepup.com',
                'mobile'            => '0934859308',
                'password'          => bcrypt('123456'),
                'role_id'           => 1,
                'country_code_id'   => 1,
                'created_at'        => $now,
                'updated_at'        => $now,
            ),
           
           
        );
        DB::table('users')->insert($array);
    }
}
