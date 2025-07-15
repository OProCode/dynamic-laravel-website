<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $seedRatings = [
            [
                'name' => 'Awful',
                'value' => 1,
                'icon' => 'poo',
                'colour' => 'yellow-800',
            ],
            [
                'name' => 'Poor',
                'value' => 2,
                'icon' => 'thumbs-down',
                'colour' => 'red-500',
            ],
            [
                'name' => 'Lacking',
                'value' => 3,
                'icon' => 'x',
                'colour' => 'red-500',
            ],
            [
                'name' => 'Mediocre',
                'value' => 4,
                'icon' => 'lemon',
                'colour' => 'yellow-200',
            ],
            [
                'name' => 'Okay',
                'value' => 5,
                'icon' => 'star',
                'colour' => 'yellow-400',
            ],
            [
                'name' => 'Good',
                'value' => 6,
                'icon' => 'star',
                'colour' => 'yellow-400',
            ],
            [
                'name' => 'Great',
                'value' => 7,
                'icon' => 'thumbs-up',
                'colour' => 'green-500',
            ],
            [
                'name' => 'Amazing',
                'value' => 8,
                'icon' => 'thumbs-up',
                'colour' => 'green-500',
            ],
            [
                'name' => 'Outstanding',
                'value' => 9,
                'icon' => 'check',
                'colour' => 'green-500',
            ],
            [
                'name' => 'Perfect',
                'value' => 10,
                'icon' => 'check',
                'colour' => 'green-500',
            ],
        ];


        foreach ($seedRatings as $seedRating) {
            Rating::create($seedRating);
        }

    }
}
