<?php

namespace Database\Seeders;

use App\Models\DefinitionRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefinitionRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedDefinitionRatings = [
            [
            'definition_id' => 1,
            'rating_id' => 1,
            'user_id' => 1,
            'value' => 1,
                ],

        ];

        foreach ($seedDefinitionRatings as $seedDefinitionRating) {
            DefinitionRating::create($seedDefinitionRating); // creates a new record
        }
    }
}
