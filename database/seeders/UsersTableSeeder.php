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
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Tinhoc@123'),
                'role' => 'admin',
                'status' => 'active',
                'created_at'=>Carbon::now(),
            ],

            //Vendor
            [
                'name' => 'Vendor',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('Tinhoc@123'),
                'role' => 'vendor',
                'status' => 'active',
                'created_at'=>Carbon::now(),
            ],

            //User Or Customer
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('Tinhoc@123'),
                'role' => 'user',
                'status' => 'active',
                'created_at'=>Carbon::now(),
            ],
        ]);
    }
}
