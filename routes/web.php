<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/favorites', [FavoriteController::class, 'index'])
    ->middleware('auth')
    ->name('favorites');

Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])
    ->middleware('auth')
    ->name('favorites.toggle');

Route::get('/assessments/{type}/{code}', [AssessmentController::class, 'index'])
    ->where('type', 'systems|countries')
    ->name('assessments.index');

Route::get('/assessments/{type}/{code}/{sis_id}', [AssessmentController::class, 'show'])
    ->where('type', 'systems|countries')
    ->name('assessments.show');

Route::get('/assessments/{assessment_id}', [AssessmentController::class, 'showAssessment'])
    ->name('assessments.show-assessment');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
