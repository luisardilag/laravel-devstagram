<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Si utilizas la misma uri, solo con nombrar la primera ruta con el nombre, 
| las demás se pueden omitir.
|
*/

Route::get('/', function () {
    return view('principal');
})->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
