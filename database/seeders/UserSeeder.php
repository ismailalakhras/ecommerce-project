<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء المستخدم الأدمن
        $admin = User::create([
            'name' => 'ismail',
            'email' => 'ismail_admin@gmail.com',
            'avatar' => 'images/avatar1.png',
            'password' => Hash::make('000000000'),
        ]);

        $admin->addRole('admin');

        $usersData = [
            [
                'name' => 'tareq',
                'email' => 'tareq@gmail.com',
                'avatar' => 'images/avatar2.svg',
                'password' => Hash::make('000000000'),
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
            User::create($userData);
        }
    }
}
