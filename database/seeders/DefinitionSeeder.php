<?php

namespace Database\Seeders;

use App\Models\Definition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefinitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedDefinitions = [

            [
                'word_id' => 1,
                'word_type_id' => 1,
                'definition' => 'Test',
                'user_id' => 1,
                'appropriate' => true,
            ],
            [
                'word_id' => 2,
                'word_type_id' => 2,
                'definition' => 'Test 2',
                'user_id' => 2,
                'appropriate' => true,
            ],

        ];

        foreach ($seedDefinitions as $seedDefinition) {
            Definition::create($seedDefinition); // creates a new record
        }

    }
}
