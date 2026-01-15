<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Page (authenticated users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Profile Routes (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin-only routes
    Route::middleware('role:admin')->group(function () {

        // Users CRUD
        Route::resource('users', UserController::class);

        // Roles CRUD
        Route::resource('roles', RoleController::class);

        // Role assignment/removal
        Route::post('/role/assign', [RoleController::class,'assign'])->name('role.assign');
        Route::delete('/role/delete/{role}', [RoleController::class,'remove'])->name('role.remove');
    });

    // Tasks CRUD (available to all authenticated users)
    Route::resource('tasks', TaskController::class);

    // Task Status Update (optional, for drag & drop)
    Route::put('/tasks/{task}/status', [TaskController::class,'updateStatus'])->name('tasks.status');
});

require __DIR__.'/auth.php';
