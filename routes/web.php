<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiesgoController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PuntoDeEncuentroController;
use App\Http\Controllers\SeguraController;
use App\Http\Controllers\GlobalController;




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

Route::resource('riesgos', RiesgoController::class);
Route::get('/riesgos/{id}/edit', [RiesgoController::class, 'edit'])->name('riesgos.edit');
Route::put('/riesgos/{id}', [RiesgoController::class, 'update'])->name('riesgos.update');
Route::get('/mapa/riesgos', [RiesgoController::class, 'mapa'])->name('riesgos.mapa');

Route::get('/mapa', [RiesgoController::class, 'mapa'])->name('riesgos.mapa');
Route::resource('seguras', App\Http\Controllers\SeguraController::class);
Route::get('/mapa', [SeguraController::class, 'mapa'])->name('seguras.mapa');  // Ruta mapa seguras
Route::get('/seguras/{id}/edit', [App\Http\Controllers\SeguraController::class, 'edit'])->name('seguras.edit');
Route::put('/seguras/{id}', [App\Http\Controllers\SeguraController::class, 'update'])->name('seguras.update');


route::prefix('puntos')->middleware('auth')->group(function(){
    route::get('/',[PuntoDeEncuentroController::class,'index'])->name('puntos.index');
    route::get('/mapa',[PuntoDeEncuentroController::class,'mapa'])->name('puntos.mapa');
    route::get('/home',[PuntoDeEncuentroController::class,'home'])->name('puntos.home');

    route::get('/create',[PuntoDeEncuentroController::class,'create'])->name('puntos.create');
    route::get('/create',[PuntoDeEncuentroController::class,'create'])->name('puntos.create');

    route::post('/store',[PuntoDeEncuentroController::class,'store'])->name('puntos.store');
    route::get('/edit/{id}',[PuntoDeEncuentroController::class,'edit'])->name('puntos.edit');
    route::put('/update/{id}',[PuntoDeEncuentroController::class,'update'])->name('puntos.update');
    Route::delete('/{id}', [PuntoDeEncuentroController::class, 'destroy'])->name('puntos.destroy');

    Route::get('/global', [GlobalController::class, 'index'])->name('global.index');

}); 