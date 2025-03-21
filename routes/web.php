<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\FilterController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [FieldController::class, 'index'])->name('index');

Route::get('/dashboard', [VacancyController::class, 'userVacancies'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [ProfileController::class, 'manageUsers'])
        ->name('admin.users')
        ->middleware('admin');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/users', [ProfileController::class, 'manageUsers'])->name('admin.users');
    Route::patch('/admin/users/{id}/toggle', [ProfileController::class, 'toggleAdmin'])->name('admin.toggleAdmin');
    Route::delete('/admin/users/{id}/delete', [ProfileController::class, 'deleteUser'])->name('admin.deleteUser');
});


Route::delete('/filters/{id}', [FilterController::class, 'destroy'])->name('filters.destroy');


Route::post('/filters', [FilterController::class, 'store'])->name('filters.store');

Route::get('/vacancy_create', [VacancyController::class, 'create'])->name('vacancy_create');

Route::get('/get-filters/{fieldId}', [VacancyController::class, 'getFilters']);

Route::post('/vacancy_create', [VacancyController::class, 'store']);

Route::get('/vacancy/{id}/edit', [VacancyController::class, 'edit'])->name('vacancy.edit');

Route::delete('/vacancy/{id}', [VacancyController::class, 'destroy'])->name('vacancy.destroy');

Route::put('/vacancy/{id}', [VacancyController::class, 'update'])->name('vacancy.update');

Route::get('/werkveld/{fieldId}/vacatures', [VacancyController::class, 'index'])->name('vacancies.byField');    

Route::delete('/admin/vacancies/{id}', [VacancyController::class, 'destroy'])->name('admin.deleteVacancy');

Route::get('/vacancies/all', [VacancyController::class, 'allVacancies'])->name('vacancies.all');

Route::get('/vacancies/search', [VacancyController::class, 'search'])->name('vacancies.search');

Route::get('/werkveld/{fieldId}/vacatures/filter', [VacancyController::class, 'filterVacancies'])->name('vacancies.filter');

Route::get('/vacatures/{id}', [VacancyController::class, 'show'])->name('vacancy.show');

Route::get('/users', [VacancyController::class, 'view'])->name('users.show');

Route::post('/vacancy', [VacancyController::class, 'getVacancyById']);



Route::get('/filters/liveSearch', [FilterController::class, 'liveSearch'])->name('filters.liveSearch');


// Route::get('/home', [VacancyController::class, 'home'])->name('index');

require __DIR__.'/auth.php';
