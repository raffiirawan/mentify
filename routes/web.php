<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MentorApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExploreController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mentee Routes
    Route::get('/explore', [ExploreController::class, 'index'])->name('mentee.explore');

    // Mentor Application Routes
    Route::get('/mentor/apply', [MentorApplicationController::class, 'create'])->name('mentor.apply');
    Route::post('/mentor/apply', [MentorApplicationController::class, 'store'])->name('mentor.apply.store');

    // Admin Routes
    Route::post('/admin/mentor/approve/{userId}', [AdminController::class, 'approveMentor'])->name('admin.mentor.approve');
    Route::post('/admin/mentor/reject/{userId}', [AdminController::class, 'rejectMentor'])->name('admin.mentor.reject');
});

require __DIR__.'/auth.php';
