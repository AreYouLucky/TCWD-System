<?php

namespace Database\Seeders;

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
        $admin = [
            [
                'name' => 'Starbooks',
                'img' => 'starbooks.png',
                'username' => 'starbooks',
                'password' => Hash::make('aa'),
                'role' => 'ADMIN',
            ],

        ];

        \App\Models\User::insertOrIgnore($admin);
    }
}
