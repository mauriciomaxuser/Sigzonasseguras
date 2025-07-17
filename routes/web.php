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
Route::get('/riesgos/{id}/edit', [RiesgoController::class, 'edit'])->name('riesgos.edit');
Route::put('/riesgos/{id}', [RiesgoController::class, 'update'])->name('riesgos.update');
// --- rutas para Zona Segura -------------------------------------------------

Route::resource('seguras', App\Http\Controllers\SeguraController::class);

Route::get('/seguras/{id}/edit', [App\Http\Controllers\SeguraController::class, 'edit'])->name('seguras.edit');
Route::put('/seguras/{id}', [App\Http\Controllers\SeguraController::class, 'update'])->name('seguras.update');