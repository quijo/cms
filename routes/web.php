<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// User Management Routes
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ChurchController;
use App\Http\Controllers\GivingController;
use App\Http\Controllers\PastorController;
use Spatie\Permission\Models\Role;

//Order matters: static first, dynamic later
//Static routes like /members/create or /settings/general should always come before parameterized routes like /members/{member} or /settings/{page}



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


// ===========================
//    Announcement Routes
// ===========================

// Only users with 'view announcements' can access index and show
Route::middleware(['auth', 'can:view announcements'])->group(function () {
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
});

// Only users with 'create announcements' can create
Route::middleware(['auth', 'can:create announcements'])->group(function () {
    Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
});

// Only users with 'edit announcements' can edit
Route::middleware(['auth', 'can:edit announcements'])->group(function () {
    Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
});

// Only users with 'delete announcements' can delete
Route::middleware(['auth', 'can:delete announcements'])->group(function () {
    Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});



// ===========================
//    Member Routes
// ===========================

// Only users with 'create members' can create
Route::middleware(['auth','can:create members'])->group(function () {
    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');
});




// Only users with 'view members' can see list or individual members
Route::middleware(['auth', 'can:view members'])->group(function () {
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/{member}', [MemberController::class, 'show'])->name('members.show');
});


// Only users with 'edit members' can edit
Route::middleware(['auth', 'can:edit members'])->group(function () {
    Route::get('/members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
});

// Only users with 'delete members' can delete
Route::middleware(['auth', 'can:delete members'])->group(function () {
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
});



// ===========================
//    Churches Routes
// ===========================
// Only Admin role can access settings
Route::resource('churches', ChurchController::class);

//=========================
// Givings Route /role:admin means this access is only for admin
//==========================
Route::middleware(['auth', 'can:view givings'])->group(function () {
    Route::get('/givings', [GivingController::class, 'index'])->name('givings.index');
    Route::get('/givings/create', [GivingController::class, 'create'])->name('givings.create');
    Route::post('/givings', [GivingController::class, 'store'])->name('givings.store');
    Route::get('/givings/{giving}/edit', [GivingController::class, 'edit'])->name('givings.edit');
     Route::get('/givings/{giving}', [GivingController::class, 'show'])->name('givings.show');
    Route::put('/givings/{giving}', [GivingController::class, 'update'])->name('givings.update');
    Route::delete('/givings/{giving}', [GivingController::class, 'destroy'])->name('givings.destroy');
});


// ===========================
//    Pastors Routes
// ===========================


Route::resource('pastors', PastorController::class);




require __DIR__.'/auth.php';
