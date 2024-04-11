<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizationController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\ScopeController;
use Laravel\Passport\Http\Controllers\TransientTokenController;
use App\Http\Controllers\GifController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/oauth/token', [AccessTokenController::class, 'issueToken']);
Route::post('/oauth/token/refresh', [AccessTokenController::class, 'refreshToken']);

// Auth
// Rutas para el inicio de sesión
Route::post('/login', [AuthController::class, 'login'])->name('login');
//Route::get('/login', [AuthController::class, 'login'])->name('login');
// Rutas para el cierre de sesión
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
// Rutas para el registro de  usuario
Route::post('/register', [AuthController::class, 'register'])->name('register');


// Conviene usar asi las rutas
// Route::get('/gifs', [
//     'uses' => 'GifController@index',
//     'as' => 'all'
// ]);

Route::post('/gifs/search', [GifController::class, 'search'])->middleware('auth:api');
Route::get('/gifs/search/{id}', [GifController::class, 'searchById'])->middleware('auth:api');

Route::/*middleware('auth:api')->*/post('/gifs/favorite', [GifController::class, 'favoriteGif']);

// Agregar el  resto  de las  rutas con middleware:
// Route::middleware('auth:api')->get('/user', function (Request $request) {return $request->user();});

Route::get('/gifs', [GifController::class, 'index']);
Route::get('/gifs/{id}', [GifController::class, 'show']);
Route::post('/gifs', [GifController::class, 'store']);
Route::put('/gifs/{id}', [GifController::class, 'update']);
Route::delete('/gifs/{id}', [GifController::class, 'destroy']);

