<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Ahmed Al-Farsi',
                'email' => 'ahmed.alfarsi@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'phone' => '0501234567',
                'address' => '123 King Street, Riyadh',
                'city' => 'Riyadh',
                'postal_code' => '11564',
                'country' => 'Saudi Arabia',
                'avatar' => null,
                'is_active' => true,
                'remember_token' => 'token',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fatima Al-Salem',
                'email' => 'fatima.alsalem@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'phone' => '0557654321',
                'address' => '45 King Fahd Road, Jeddah',
                'city' => 'Jeddah',
                'postal_code' => '21411',
                'country' => 'Saudi Arabia',
                'avatar' => null,
                'is_active' => true,
                'remember_token' => 'token',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mohamed Hassan',
                'email' => 'mohamed.hassan@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'phone' => '0549876543',
                'address' => '789 Al-Nahda Street, Dammam',
                'city' => 'Dammam',
                'postal_code' => '32241',
                'country' => 'Saudi Arabia',
                'avatar' => null,
                'is_active' => true,
                'remember_token' => 'token',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sara Al-Mutairi',
                'email' => 'sara.almutairi@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'phone' => '0531239876',
                'address' => '12 Olaya Street, Riyadh',
                'city' => 'Riyadh',
                'postal_code' => '12345',
                'country' => 'Saudi Arabia',
                'avatar' => null,
                'is_active' => true,
                'remember_token' => 'token',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Yousef Al-Harbi',
                'email' => 'yousef.alharbi@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'phone' => '0509876543',
                'address' => '56 Prince Sultan Road, Mecca',
                'city' => 'Mecca',
                'postal_code' => '21955',
                'country' => 'Saudi Arabia',
                'avatar' => null,
                'is_active' => true,
                'remember_token' => 'token',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
