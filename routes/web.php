<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [VacancyController::class, 'userVacancies'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/vacancy_create', function () {
    return view('vacancy_create');
})->name('vacancy_create');

Route::post('/vacancy_create', [VacancyController::class, 'store']);

Route::get('/users', [VacancyController::class, 'view'])->name('users.show');

require __DIR__.'/auth.php';
