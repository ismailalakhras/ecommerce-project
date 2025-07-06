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
            'password' => Hash::make('000000000'),
        ]);

        $admin->addRole('admin');

        $usersData = [
            [
                'name' => 'ismail',
                'email' => 'ismail_user@gmail.com',
                'password' => Hash::make('000000000'),
            ],
            [
                'name' => 'user-1',
                'email' => 'user-1@gmail.com',
                'password' => Hash::make('0'),
            ],
            [
                'name' => 'user-2',
                'email' => 'user-2@gmail.com',
                'password' => Hash::make('0'),
            ],
            [
                'name' => 'user-3',
                'email' => 'user-3@gmail.com',
                'password' => Hash::make('0'),
            ],

             [
                'name' => 'ismail real gmail',
                'email' => 'ismail.malakhras@gmail.com',
                'password' => Hash::make('0'),
            ],
        ];

        foreach ($usersData as $userData) {
            User::create($userData);
        }
    }
}
