<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordTypeController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\DefinitionController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * GET - retrieve data
 * POST - send data that will be manipulated (such as logging in)
 * UPDATE - update data
 * DELETE/DESTROY - remove data
 * INFO - get info about data
 */

/**
 * STATIC PAGES
 */

Route::get('/', [StaticPageController::class, 'home'])
    ->name('static.home');
Route::get('/privacy', [StaticPageController::class, 'privacy'])
    ->name('static.privacy');
Route::get('/contact', [StaticPageController::class, 'contact'])
    ->name('static.contact');
Route::get('/welcome', [StaticPageController::class, 'welcome'])
    ->name('static.welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * RATINGS
 */

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');
    Route::get('/ratings/add', [RatingController::class, 'create'])->name('ratings.add');
    Route::get('/ratings/{rating}', [RatingController::class, 'show'])->name('ratings.show');
    Route::get('/ratings/{rating}/edit', [RatingController::class, 'edit'])->name('ratings.edit');
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store'); // replaces entire field
    Route::put('/ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update'); // replaces entire field
    Route::patch('/ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update'); // edits specific elements
    Route::get('/ratings/{rating}/delete', [RatingController::class, 'delete'])->name('ratings.delete');
    Route::delete('/ratings/{rating}', [RatingController::class, 'destroy'])->name('ratings.destroy'); // edits specific elements
});

/**
 * WORDTYPES
 */

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wordtypes', [WordTypeController::class, 'index'])->name('wordtypes.index');
    Route::get('/wordtypes/add', [WordTypeController::class, 'create'])->name('wordtypes.add');
    Route::get('/wordtypes/{wordType}', [WordTypeController::class, 'show'])->name('wordtypes.show');
    Route::get('/wordtypes/{wordType}/edit', [WordTypeController::class, 'edit'])->name('wordtypes.edit');
    Route::post('/wordtypes', [WordTypeController::class, 'store'])->name('wordtypes.store');
    Route::put('/wordtypes/{wordType}', [WordTypeController::class, 'update'])->name('wordtypes.update');
    Route::patch('/wordtypes/{wordType}', [WordTypeController::class, 'update'])->name('wordtypes.update');
    Route::get('/wordtypes/{wordType}/delete', [WordTypeController::class, 'delete'])->name('wordtypes.delete');
    Route::delete('/wordtypes/{wordType}', [WordTypeController::class, 'destroy'])->name('wordtypes.destroy');
});

/**
 * WORDS
 */

//Route::resource('/words', WordController::class)->only(['index', 'show']);
//Route::middleware('auth:sanctum')->group(function () {
//    Route::resource('/words', WordController::class)->except(['index', 'show']);
//    Route::get('/words/add', [WordController::class, 'create'])->name('words.add');
//    Route::get('/words/{word}/delete', [WordController::class, 'delete'])->name('words.delete');
//    Route::get('/words/add', [WordController::class, 'create'])->name('words.add');
//});

Route::get('/words', [WordController::class, 'index'])->name('words.index');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/words/add', [WordController::class, 'create'])->name('words.add');
    Route::get('/words/{word}/edit', [WordController::class, 'edit'])->name('words.edit');
    Route::post('/words', [WordController::class, 'store'])->name('words.store');
    Route::put('/words/{word}', [WordController::class, 'update'])->name('words.update');
    Route::patch('/words/{word}', [WordController::class, 'update'])->name('words.update');
    Route::get('/words/{word}/delete', [WordController::class, 'delete'])->name('words.delete');
    Route::delete('/words/{word}', [WordController::class, 'destroy'])->name('words.destroy');
});
Route::get('/words/{word}', [WordController::class, 'show'])->name('words.show');

/**
 * DEFINITIONS
 */

//Route::resource('/definitions', DefinitionController::class)->only(['index', 'show']);
//Route::middleware('auth:sanctum')->group(function () {
//    Route::resource('/definitions', DefinitionController::class)->except(['index', 'show']);
//    Route::get('/definitions/add', [DefinitionController::class, 'create'])->name('definitions.add');
//    Route::get('/definitions/{definition}/edit', [DefinitionController::class, 'edit'])->name('definitions.edit');
//    Route::get('/definitions/{definition}/delete', [DefinitionController::class, 'delete'])->name('definitions.delete');
//});

Route::get('/definitions', [DefinitionController::class, 'index'])->name('definitions.index');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/definitions/add', [DefinitionController::class, 'create'])->name('definitions.add');
    Route::get('/definitions/create', [DefinitionController::class, 'store'])->name('definitions.store');
    Route::get('/definitions/{definition}/edit', [DefinitionController::class, 'edit'])->name('definitions.edit');
    Route::post('/definitions', [DefinitionController::class, 'store'])->name('definitions.store');
    Route::put('/definitions/{definition}', [DefinitionController::class, 'update'])->name('definitions.update');
    Route::patch('/definitions/{definition}', [DefinitionController::class, 'update'])->name('definitions.update');
    Route::get('/definitions/{definition}/delete', [DefinitionController::class, 'delete'])->name('definitions.delete');
    Route::delete('/definitions/{definition}', [DefinitionController::class, 'destroy'])->name('definitions.destroy');
});
Route::get('/definitions/{definition}', [DefinitionController::class, 'show'])->name('definitions.show');

/**
 * USERS
 */

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/add', [UserController::class, 'create'])->name('users.add');
    Route::get('/users/create', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';
