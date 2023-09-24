<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'Username' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('Gempita05'),
                'role' => 0
            ],
            [
                'Username' => 'Seller',
                'email' => 'seller@gmail.com',
                'password' => bcrypt('Gempita05'),
                'role' => 1
            ],
            [
                'Username' => 'Mitra',
                'email' => 'mitra@gmail.com',
                'password' => bcrypt('Gempita05'),
                'role' => 2
            ],
            [
                'Username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Gempita05'),
                'role' => 3
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
