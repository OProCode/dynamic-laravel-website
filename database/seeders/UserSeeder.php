<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ROLES

        $admin = Role::create(['name' => 'admin']);
        $staff = Role::create(['name' => 'staff']);
        $user = Role::create(['name' => 'user']);
        $other = Role::create(['name' => 'other']);

        // GLOBAL PERMISSIONS

        $browse = Permission::create(['name' => 'browse']);
        $search = Permission::create(['name' => 'search']);
        $add = Permission::create(['name' => 'add']);
        $edit = Permission::create(['name' => 'edit']);
        $delete = Permission::create(['name' => 'delete']);

        // USER PERMISSIONS

        $browseUser = Permission::create(['name' => 'browse user']);
        $searchUser = Permission::create(['name' => 'search user']);
        $addUser = Permission::create(['name' => 'add user']);
        $editUser = Permission::create(['name' => 'edit user']);
        $deleteUser = Permission::create(['name' => 'delete user']);

        // WORD PERMISSIONS

        $browseWord = Permission::create(['name' => 'browse word']);
        $searchWord = Permission::create(['name' => 'search word']);
        $addWord = Permission::create(['name' => 'add word']);
        $editWord = Permission::create(['name' => 'edit word']);
        $deleteWord = Permission::create(['name' => 'delete word']);

        // WORD TYPE PERMISSIONS

        $browseWordType = Permission::create(['name' => 'browse word type']);
        $searchWordType = Permission::create(['name' => 'search word type']);
        $addWordType = Permission::create(['name' => 'add word type']);
        $editWordType = Permission::create(['name' => 'edit word type']);
        $deleteWordType = Permission::create(['name' => 'delete word type']);

        // DEFINITION PERMISSIONS

        $browseDefinition = Permission::create(['name' => 'browse definition']);
        $searchDefinition = Permission::create(['name' => 'search definition']);
        $addDefinition = Permission::create(['name' => 'add definition']);
        $editDefinition = Permission::create(['name' => 'edit definition']);
        $deleteDefinition = Permission::create(['name' => 'delete definition']);

        // RATING PERMISSIONS

        $browseRating = Permission::create(['name' => 'browse rating']);
        $searchRating = Permission::create(['name' => 'search rating']);
        $addRating = Permission::create(['name' => 'add rating']);
        $editRating = Permission::create(['name' => 'edit rating']);
        $deleteRating = Permission::create(['name' => 'delete rating']);

        // DEFINITION RATING PERMISSIONS

        $browseDefinitionRating = Permission::create(['name' => 'browse definition rating']);
        $searchDefinitionRating = Permission::create(['name' => 'search definition rating']);
        $addDefinitionRating = Permission::create(['name' => 'add definition rating']);
        $editDefinitionRating = Permission::create(['name' => 'edit definition rating']);
        $deleteDefinitionRating = Permission::create(['name' => 'delete definition rating']);

        $admin->givePermissionTo(
            $browseUser, $searchUser, $addUser, $editUser, $deleteUser,
            $browseWord, $searchWord, $addWord, $editWord, $deleteWord,
            $browseWordType, $searchWordType, $addWordType, $editWordType, $deleteWordType,
            $browseDefinition, $searchDefinition, $addDefinition, $editDefinition, $deleteDefinition,
            $browseRating, $searchRating, $addRating, $editRating, $deleteRating,
            $browseDefinitionRating, $searchDefinitionRating, $addDefinitionRating, $editDefinitionRating, $deleteDefinitionRating,
        );
        $staff->givePermissionTo(
            $browseUser, $searchUser, $addUser, $editUser,
            $browseWord, $searchWord, $addWord, $editWord,
            $addDefinition, $editDefinition, $deleteDefinition,
            $browseDefinitionRating, $searchDefinitionRating, $addDefinitionRating, $deleteDefinitionRating,
        );
        $user->givePermissionTo(
            $browseUser, $searchUser, $editUser, $deleteUser,
            $browseWord, $searchWord,
            $browseDefinition, $searchDefinition, $addDefinition, $editDefinition, $deleteDefinition,
            $browseDefinitionRating, $searchDefinitionRating, $addDefinitionRating, $deleteDefinitionRating,
        );
        $other->givePermissionTo(
            $browseWord, $searchWord,
            $browseDefinition, $searchDefinition,
        );

        $seedUsers =
            [
                [
                    'id' => 1,
                    'name' => 'Oliver',
                    'email' => 'j203412@tafe.wa.edu.au',
                    'password' => 'admin',
                    'role' => 'admin'
                ],
                [
                    'id' => 2,
                    'name' => 'Tamara',
                    'email' => 'tammyperro@hotmail.com',
                    'password' => 'staff',
                    'role' => 'staff'
                ],
                [
                    'id' => 3,
                    'name' => 'Sarah',
                    'email' => 'sarahchaffey459@gmail.com',
                    'password' => 'staff',
                    'role' => 'staff'
                ],
                [
                    'id' => 4,
                    'name' => 'Luke',
                    'email' => 'luke.greenwood18@gmail.com',
                    'password' => 'user',
                    'role' => 'user'
                ],
                [
                    'id' => 5,
                    'name' => 'Rhys',
                    'email' => 'rhys.mader@winterwiregames.com',
                    'password' => 'user',
                    'role' => 'user'
                ],
                [
                    'id' => 6,
                    'name' => 'Michael',
                    'email' => 'michaeldainesmusic@hotmail.com',
                    'password' => 'staff',
                    'role' => 'staff'
                ],
            ];

        foreach ($seedUsers as $seedUser) {
            $user = User::create($seedUser);
            $user->assignRole($seedUser['role']);
        }

    }
}
