<?php

namespace Database\Seeders;

use App\Models\WordType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedTypes =
        [
            ['id' => 1, 'code' => 'OT', 'name' => 'Other',],
            ['id' => 2, 'code' => 'AC', 'name' => 'Acronym',],
            ['id' => 3, 'code' => 'TE', 'name' => 'Term',],
            ['id' => 4, 'code' => 'AB', 'name' => 'Abbreviation',],
            ['id' => 5, 'code' => 'MN', 'name' => 'Mnemonic',],
            ['id' => 6, 'code' => 'BA', 'name' => 'Backronym',],
            ['id' => 7, 'code' => 'IN', 'name' => 'Initialism',]
        ];

        foreach ($seedTypes as $seedType) {
            WordType::create($seedType); // creates a new record
        }
    }
}
