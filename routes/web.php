<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// User Management Routes
use App\Http\Controllers\UserController;

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
});




//admin is permitted to view users, but only editor can create, edit or delete users.
Route::middleware(['auth', 'can:view users'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('can:create users');
    Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('can:create users');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('can:edit users');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('can:edit users');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('can:delete users');
});






require __DIR__.'/auth.php';
