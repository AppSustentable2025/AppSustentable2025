<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TareaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user','fireauth');

///Rutas views

Route::get('/lista-actividades', function () {
    return view('lista-actividades');
});

Route::get('/lista-tareas', function () {
    return view('lista-tareas');
});

Route::get('/home', function () {
    return view('home');
});

///Ruta Crear Tarea

Route::get('/crear-actividades', function () {
    return view('crear-actividades');
})->name('actividades.create');
