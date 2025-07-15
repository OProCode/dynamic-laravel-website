<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Word;
use App\Models\WordType;
use App\Models\Definition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // TODO: User ID defaults to 1, regardless of seeder value

        $user = User::findOrFail(1);

        $seedWords = [
            [
                'name' => 'FTP',
                'definition' => 'File Transfer Protocol',
                'word_type' => 'Initialism',
                'user_id' => 1
            ],

            [
                'name' => 'FTP',
                'definition' => 'Fast Track Program',
                'word_type' => 'Initialism',
                'user_id' => 1
            ],

            [
                'name' => 'IBM',
                'definition' => 'International Business Machines',
                'word_type' => 'Initialism',
                'user_id' => 2
            ],

            [
                'name' => 'laser',
                'definition' => 'Light Amplification by Stimulated Emission of Radiation',
                'word_type' => 'Acronym',
                'user_id' => 3
            ],

            [
                'name' => 'MoSCoW',
                'definition' => "Must Have, Should Have, Could Have, Won't Have",
                'word_type' => 'Acronym',
                'user_id' => 2
            ],

            [
                'name' => 'THROAT',
                'definition' => 'The Huge Resource Of Acronyms and Terms',
                'word_type' => 'Backronym',
                'user_id' => 2
            ],

            [
                'name' => 'CRUD',
                'definition' => 'Create, Retrieve, Update, Delete',
                'word_type' => 'Acronym',
                'user_id' => 2
            ],

            [
                'name' => 'KISS',
                'definition' => 'Keep It Simple, Stupid',
                'word_type' => 'Acronym',
                'user_id' => 3
            ],

            [
                'name' => 'PHP',
                'definition' => 'PHP Hypertext Preprocessor',
                'word_type' => 'Name',
                'user_id' => 1
            ],

            [
                'name' => 'IMO',
                'definition' => 'In My Opinion',
                'word_type' => 'Abbreviation',
                'user_id' => 2
            ],

            [
                'name' => 'IMHO',
                'definition' => 'In My Honest Opinion',
                'word_type' => 'Abbreviation',
                'user_id' => 1
            ],

            [
                'name' => 'DRY',
                'definition' => "Don't Repeat Yourself",
                'word_type' => 'Acronym',
                'user_id' => 3
            ],

            [
                'name' => 'INC',
                'definition' => 'Incorporated',
                'word_type' => 'Abbreviation',
                'user_id' => 1
            ],

            [
                'name' => 'Silly Old Henry Carried a Horse To Our Abattoir',
                'definition' => 'Sin (Opposite/Hypotenuse) Cosine (Adjacent/Hypotenuse) Tan (Opposite/Adjacent)',
                'word_type' => 'Mnemonic',
                'user_id' => 1
            ],

            [
                'name' => 'SQL',
                'definition' => 'Structured Query Language',
                'word_type' => 'Initialism',
                'user_id' => 4
            ],

            [
                'name' => 'BTW',
                'definition' => 'By The Way',
                'word_type' => 'Abbreviation',
                'user_id' => 2
            ],

            [
                'name' => "Can't",
                'definition' => 'cannot',
                'word_type' => 'Contraction',
                'user_id' => 1
            ],

            [
                'name' => 'Dr.',
                'definition' => 'Doctor',
                'word_type' => 'Contraction',
                'user_id' => 2
            ],
            [
                'name' => 'DAW',
                'definition' => 'Digital Audio Workstation',
                'word_type' => 'Initialism',
                'user_id' => 2
            ],
        ];

        $wordTypes = WordType::all(); // Seed all wordTypes

        foreach ($seedWords as $seedWord) {
            $wordType = $wordTypes->firstWhere('name', $seedWord['word_type']); // Check if each word type exists

            /*
             * If the word type is not in the collection then we create the new word type
             * with a random code made from the word type's name (currently not checking
             * for duplicate codes/names), and retrieving the new collection of word types.
             */

            if (is_null($wordType)) { // Run if word type not found
                $seedWordType = $seedWord['word_type']; // Get new word type
                $swLength = Str::length($seedWordType); // Get new word type length
                $codeExists = true; // Flag new word as found (but not in word type list)
                $codeLetters = Str::substr($seedWordType, 0, 2); // Get first 2 characters of new word type
                $firstLetter = 0; // Set counter for first letter of new word type code
                while ($codeExists && $firstLetter < ($swLength - 1)) { // Run while word type is found and iterate over word length
                    $secondLetter = 1; // Set counter for first letter of new word type code
                    while ($codeExists && $secondLetter < $swLength) { // Run while word type is found and iterate over word length
                        $codeLetters = Str::substr($seedWordType, $firstLetter, 1).Str::substr($seedWordType, $secondLetter, 1); // . = concatenate
                        $codeExists = WordType::where('code', '=', $codeLetters)->get()->count() ?? false; // Check if new code already exists
                        $secondLetter++; // Go to next letter
                    }
                    $firstLetter++; // Go to next letter
                }

                $user = User::find($seedWord['user_id']);

                if (is_null($user)) {
                    $this->command->warn("User not found for user_id: {$seedWord['user_id']}");
                    continue;
                }

                $wordType = WordType::create([
                    'code' => Str::upper($codeLetters),
                    'name' => $seedWord['word_type'],
                ]);

                $this->command->line("  - Created new word type: {$wordType->code} {$wordType->name}", 'comment');
                $wordTypes = WordType::all(); // Save new word types
            }

            // Create the word if it does not exist
            $newWord = [
                'name' => $seedWord['name'],
                'word_type_id' => $wordType->id,
                'user_id' => $user->id,
            ];

            $word = Word::firstWhere('name', $seedWord['name']);
            if (is_null($word)) {
                $word = Word::create($newWord);
            }

            $seedDefinition = [
                'definition' => $seedWord['definition'],
                'word_type_id' => $wordType->id,
                'user_id' => $user->id,
            ];

            $definition = Definition::create($seedDefinition);

            $word->definitions()->save($definition);

        }

    }
}
