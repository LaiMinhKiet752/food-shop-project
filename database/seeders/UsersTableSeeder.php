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
                'shop_name' => '',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Tinhoc@123'),
                'role' => 'admin',
                'status' => 'active',
                'created_at'=>Carbon::now(),
            ],

            //Vendor
            [
                'name' => 'Nature Food',
                'shop_name' => 'Nature Food',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('Tinhoc@123'),
                'role' => 'vendor',
                'status' => 'active',
                'created_at'=>Carbon::now(),
            ],

            //User Or Customer
            [
                'name' => 'Minh Kiet',
                'shop_name' => '',
                'username' => 'kiet',
                'email' => 'laiminhkiet07052002@gmail.com',
                'password' => Hash::make('Tinhoc@123'),
                'role' => 'user',
                'status' => 'active',
                'created_at'=>Carbon::now(),
            ],
        ]);
    }
}
