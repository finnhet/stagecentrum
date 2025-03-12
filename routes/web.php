<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\FieldController;

Route::get('/', [FieldController::class, 'index']);

Route::get('/dashboard', [VacancyController::class, 'userVacancies'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/vacancy_create', function () {
    $fields = \App\Models\Field::all();
    return view('vacancy_create', compact('fields'));
})->name('vacancy_create');


Route::post('/vacancy_create', [VacancyController::class, 'store']);

Route::get('/vacancy/{id}/edit', [VacancyController::class, 'edit'])->name('vacancy.edit');

Route::delete('/vacancy/{id}', [VacancyController::class, 'destroy'])->name('vacancy.destroy');

Route::put('/vacancy/{id}', [VacancyController::class, 'update'])->name('vacancy.update');

Route::get('/werkveld/{fieldId}/vacatures', [VacancyController::class, 'index'])->name('vacancies.byField');

Route::get('/werkveld/{fieldId}/vacatures/filter', [VacancyController::class, 'filterVacancies'])->name('vacancies.filter');

Route::get('/vacatures/{id}', [VacancyController::class, 'show'])->name('vacancy.show');

Route::get('/vacancy/{id}', [VacancyController::class, 'show'])->name('vacancy.show');

Route::get('/users', [VacancyController::class, 'view'])->name('users.show');

Route::post('/vacancy', [VacancyController::class, 'getVacancyById']);

require __DIR__.'/auth.php';
