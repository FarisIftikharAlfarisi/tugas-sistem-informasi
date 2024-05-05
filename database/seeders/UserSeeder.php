<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secretAdmin'),
            'role' => "Admin"
        ]);
        User::create([
            'name' => 'Admin Movie',
            'email' => 'adminmovie@example.com',
            'password' => Hash::make('secretAdmin2'),
            'role' => "Movie Officer",
        ]);
        User::create([
            'name' => 'Cashier 1',
            'email' => 'cashier@example.com',
            'password' => Hash::make('secretCashier'),
            'role' => "Cashier",
        ]);
    }
}
