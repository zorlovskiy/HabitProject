<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Habit\HabitCreateController;
use App\Http\Controllers\API\Habit\HabitDeleteController;
use App\Http\Controllers\API\Habit\HabitUpdateController;
use App\Http\Controllers\API\ProgressMark\ProgressMarkCreateController;
use App\Http\Controllers\API\Register\RegisterController;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::post('login', LoginController::class)->name('login');

Route::post('/register', RegisterController::class)->name('register');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('habits')->name('habits.')->group(function () {
        Route::post('/', HabitCreateController::class)->name('create');
        Route::delete('/', HabitDeleteController::class)->name('delete');

        Route::prefix('/{habit}')->name('habit.')->group(function () {
            Route::put('/', HabitUpdateController::class)->name('update');
        });
    });

    Route::prefix('progress')->name('progress.')->group(function () {
        Route::post('/', ProgressMarkCreateController::class)->name('create');
    });
});
