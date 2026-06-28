<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('designations', DesignationController::class);

Route::get('/users', [UserController::class,'index'])->name('users.index');

Route::get('/users/list', [UserController::class,'list'])->name('users.list');

Route::get('/users/create', [UserController::class,'create'])->name('users.create');

Route::post('/users', [UserController::class,'store'])->name('users.store');

Route::get('/users/{id}/edit', [UserController::class,'edit'])->name('users.edit');

Route::put('/users/{id}', [UserController::class,'update'])->name('users.update');

Route::delete('/users/{id}', [UserController::class,'destroy']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';