<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VeterinarianController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ServiceController;

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

Route::resource('veterinarians', VeterinarianController::class)
    ->middleware(['auth', 'role:admin']);

Route::resource('appointments', AppointmentController::class)
    ->only([
        'create',
        'store',
        'edit',
        'update',
        'destroy',
    ])
    ->middleware(['auth', 'role:admin']);


Route::resource('appointments', AppointmentController::class)
    ->only([
        'index',
        'show',
    ])
    ->middleware('auth');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::post(
        '/pets/{pet}/notes',
        [NoteController::class, 'storeForPet']
    )->name('pets.notes.store');


    Route::post(
        '/appointments/{appointment}/notes',
        [NoteController::class, 'storeForAppointment']
    )->name('appointments.notes.store');


    Route::delete(
        '/notes/{note}',
        [NoteController::class, 'destroy']
    )->name('notes.destroy');


});

Route::resource('services', ServiceController::class)
    ->middleware(['auth', 'role:admin']);
