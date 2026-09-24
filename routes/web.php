<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.authenticate');
});


Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::resource('pets', PetController::class)
    ->only([
        'create',
        'store',
        'edit',
        'update',
        'destroy',
    ])
    ->middleware(['auth', 'role:admin']);


Route::resource('pets', PetController::class)
    ->only([
        'index',
        'show',
    ])
    ->middleware('auth');
