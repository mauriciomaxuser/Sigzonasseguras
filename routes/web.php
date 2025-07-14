<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiesgoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect()->route('login.form');
});

Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

// ------------------------------------------------------ Rutas para Zona de Riesgo -------------------------------------------------
Route::resource('riesgos', RiesgoController::class);