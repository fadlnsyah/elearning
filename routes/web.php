<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Enrollment Page (Find Classes)
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::post('/classes/{courseClass}/enroll', [ClassController::class, 'enroll'])->name('classes.enroll');

    // Specific Class Context
    Route::prefix('class/{courseClass}')->name('courses.')->group(function () {
        Route::get('/', [ClassController::class, 'show'])->name('show');

        // Assignments
        Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
        Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store'); // Teacher
        Route::get('/assignments/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');
        Route::post('/assignments/{assignment}/submit', [AssignmentController::class, 'submit'])->name('assignments.submit'); // Student

        // Attendance
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store'); // Teacher
        Route::post('/attendance/submit', [AttendanceController::class, 'submit'])->name('attendance.submit'); // Student
    });

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Simple Admin route protection check inside controller or here
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
        Route::post('/classes', [AdminController::class, 'storeClass'])->name('classes.store');
    });
});
