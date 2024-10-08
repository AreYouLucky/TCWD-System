<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badge = [
            [
                'name' => 'Breeze Craver ',
                'img' => 'easy.png',
                'description' => 'Beat All the Easy Questions',
            ],
            [
                'name' => 'Grinderist Nerd ',
                'img' => 'medium.png',
                'description' => 'Beat All the Average Questions',
            ],
            [
                'name' => 'Challenge Artisan',
                'img' => 'hard.png',
                'description' => 'Beat All the Hard Questions',
            ],
            [
                'name' => 'Survivor (Against All Odds)',
                'img' => 'survivor.png',
                'description' => 'Try All Levels',
            ],
            [
                'name' => 'Dark Revenant',
                'img' => 'dark.png',
                'description' => 'Earn at least three(3) Badges',
            ],
            [
                'name' => 'Kneel Before Me',
                'img' => 'king.png',
                'description' => 'Beat All Levels',
            ]

        ];

        \App\Models\Badge::insertOrIgnore($badge);
    }
}
