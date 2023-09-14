<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserstableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = [ 
            'name' => 'Gempita',
            'email' => 'gempita@gmail.com',
            'password' => bcrypt('Gempita05'),
        ];
    
        if (!User::where('email', $adminUser['email'])->exists()) {
            User::create($adminUser);
        }
    }
    
}