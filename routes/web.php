<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('pets', PetController::class);
