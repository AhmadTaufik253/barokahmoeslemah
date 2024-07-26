<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'Admin123@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('Admin123'),
                'phone' => '087709020299',
                'role' => 'Admin',
                'address' => 'Jl. ciracas',
                // 'province_id' => '34',
                // 'city_id' => '278',
                // 'subdistrict_id' => '3907',
                'postcode' => '40287'
            ],
            [
                'name' => 'User',
                'username' => 'User123',
                'email' => 'User123@gmail.com',
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make('User123'),
                'phone' => '08192392929',
                'role' => 'Customer',
                'address' => 'Jl. ciracas',
                // 'province_id' => '34',
                // 'city_id' => '278',
                // 'subdistrict_id' => '3907',
                'postcode' => '40287'
            ],
        );
        foreach($data AS $d){
            User::create([
                'name' => $d['name'],
                'username' => $d['username'],
                'email' => $d['email'],
                'email_verified_at' => $d['email_verified_at'],
                'phone' => $d['phone'],
                'role' => $d['role'],
                'address' => $d['address'],
                // 'province_id' => $d['province_id'],
                // 'city_id' => $d['city_id'],
                // 'subdistrict_id' => $d['subdistrict_id'],
                'postcode' => $d['postcode'],
                'password' => $d['password']
            ]);
        }
    }
}
