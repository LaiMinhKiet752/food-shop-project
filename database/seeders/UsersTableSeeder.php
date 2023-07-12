<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
            //Admin
            [
                'name' => 'SuperAdmin',
                'username' => 'superadmin',
                'email' => 'kietminh070502@gmail.com',
                'password' => Hash::make('Tinhoc@123'),
                'role' => 'admin',
                'status' => 'active',
                'created_at'=>Carbon::now(),
            ],

            //User Or Customer
            [
                'name' => 'Minh Kiet',
                'username' => 'laiminhkiet',
                'email' => 'laiminhkiet07052002@gmail.com',
                'password' => Hash::make('Tinhoc@123'),
                'role' => 'user',
                'status' => 'active',
                'created_at'=>Carbon::now(),
            ],
        ]);
    }
}
