<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DifficultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            [
                'name' => 'Easy',
                'score' => 10,
                'round' => 10,
                'time' => 10
            ],

            [
                'name' => 'Medium',
                'score' => 15,
                'round' => 10,
                'time' => 15
            ],
            [
                'name' => 'Difficult',
                'score' => 20,
                'round' => 10,
                'time' => 20
            ],
        ];

        \App\Models\Difficulty::insertOrIgnore($admin);
    }
}
