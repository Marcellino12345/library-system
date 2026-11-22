<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Fitur internal: wajib login (admin dan petugas).
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('books', BookController::class);

    Route::resource('categories', CategoryController::class)
        ->only(['index', 'store', 'destroy']);

    Route::resource('members', MemberController::class)
        ->only(['index', 'store', 'destroy']);

    Route::resource('borrowings', BorrowingController::class)
        ->only(['index', 'create', 'store']);

    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
        ->name('borrowings.return');
});

// Hanya admin yang boleh mengelola akun pengguna (Gate manage-users).
Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});