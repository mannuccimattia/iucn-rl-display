<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('favourites', function () {
    return view('favourites');
})->name('favourites');


Route::get('/assessments/{type}/{code}', [AssessmentController::class, 'index'])
    ->where('type', 'systems|countries')
    ->name('assessments.index');

Route::get('/assessments/{type}/{code}/{taxon_id}', [AssessmentController::class, 'show'])
    ->name('assessments.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
