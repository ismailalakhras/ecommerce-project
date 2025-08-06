<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'ismail_admin@gmail.com'],
            [
                'name' => 'ismail',
                'avatar' => 'images/avatar1.png',
                'password' => Hash::make('000000000'),
            ]
        );

        if (!$admin->hasRole('admin')) {
            $admin->addRole('admin');
        }

        // Regular users
        $usersData = [
            [
                'name' => 'tareq',
                'email' => 'tareq@gmail.com',
                'avatar' => 'images/avatar2.svg',
                'password' => Hash::make('0'),
            ],
            [
                'name' => 'osama',
                'email' => 'osama@gmail.com',
                'avatar' => 'images/avatar3.svg',
                'password' => Hash::make('0'),
            ],
            [
                'name' => 'baha',
                'email' => 'baha@gmail.com',
                'avatar' => 'images/avatar4.svg',
                'password' => Hash::make('0'),
            ],
            [
                'name' => 'ismail real gmail',
                'email' => 'ismail.malakhras@gmail.com',
                'avatar' => 'images/avatar5.svg',
                'password' => Hash::make('0'),
            ],
        ];

        foreach ($usersData as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            if (!$user->hasRole('user')) {
                $user->addRole('user');
            }
        }
    }
}
