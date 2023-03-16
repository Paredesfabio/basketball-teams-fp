<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('team')->group(function () {
    Route::get('/', [TeamController::class, 'index'])->name('team.index');
    Route::get('/create', [TeamController::class, 'create'])->name('team.create');
    Route::get('/{team}', [TeamController::class, 'details'])->name('team.details');
    Route::post('/store', [TeamController::class, 'store'])->name('team.store');
    Route::get('/edit/{team}', [TeamController::class, 'edit'])->name('team.edit');
    Route::put('/update/{team}', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/delete/{team}', [TeamController::class, 'delete'])->name('team.delete');

    Route::prefix('staff')->group(function () {
        Route::get('/{team}', [TeamController::class, 'createStaff'])->name('staff.create');
        Route::post('/store', [TeamController::class, 'storeStaff'])->name('staff.store');
    });
});

Route::prefix('player')->group(function () {
    Route::get('/', [PlayerController::class, 'index'])->name('player.index');
    Route::get('/create/{team}', [PlayerController::class, 'create'])->name('player.create');
    Route::get('/{player}', [PlayerController::class, 'details'])->name('player.details');
    Route::post('/store', [PlayerController::class, 'store'])->name('player.store');
    Route::get('/edit/{player}', [PlayerController::class, 'edit'])->name('player.edit');
    Route::put('/update/{player}', [PlayerController::class, 'update'])->name('player.update');
    Route::delete('/delete/{player}', [PlayerController::class, 'delete'])->name('player.delete');
});

Route::prefix('division')->group(function () {
    Route::get('/', [DivisionController::class, 'index'])->name('division.index')->middleware('auth');
    Route::get('/{division}', [DivisionController::class, 'teams'])->name('division.teams');
});

Route::prefix('country')->group(function () {
    Route::get('/', [CountryController::class, 'index'])->name('country.index')->middleware('auth');
});


Auth::routes();


