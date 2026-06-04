<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MentorApplicationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mentee Routes
    Route::get('/explore', [ExploreController::class, 'index'])->name('mentee.explore');
    Route::get('/explore/mentor/{id}', [ExploreController::class, 'show'])->name('mentee.mentor.detail');

    // Booking Routes (Mentee)
    Route::get('/explore/mentor/{mentor_id}/book', [BookingController::class, 'create'])->name('mentee.booking.create');
    Route::post('/explore/mentor/{mentor_id}/book', [BookingController::class, 'store'])->name('mentee.booking.store');

    // Mentor Application Routes
    Route::get('/mentor/apply', [MentorApplicationController::class, 'create'])->name('mentor.apply');
    Route::post('/mentor/apply', [MentorApplicationController::class, 'store'])->name('mentor.apply.store');

    // Admin Routes
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/{user}', [AdminController::class, 'userDetail'])->name('user-detail');
        Route::patch('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('user.toggle-status');
        
        Route::get('/mentors', [AdminController::class, 'mentors'])->name('mentors');
        Route::post('/mentor/{userId}/approve', [AdminController::class, 'approveMentor'])->name('mentor.approve');
        Route::post('/mentor/{userId}/reject', [AdminController::class, 'rejectMentor'])->name('mentor.reject');
        
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
        
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
        Route::patch('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
    });

    // Legacy admin routes (for backward compatibility)
    Route::post('/admin/mentor/approve/{userId}', [AdminController::class, 'approveMentor'])->name('admin.mentor.approve');
    Route::post('/admin/mentor/reject/{userId}', [AdminController::class, 'rejectMentor'])->name('admin.mentor.reject');
});

require __DIR__.'/auth.php';
