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



        $admin = User::create([
            'name' => 'ismail admin',
            'email' => 'ismail_admin@gmail.com',
            'password' =>  Hash::make('000000000'),
        ]);


         $user = User::create([
            'name' => 'ismail user',
            'email' => 'ismail_user@gmail.com',
            'password' =>  Hash::make('000000000'),
        ]);



        $admin->addRole('admin');
    }
}
