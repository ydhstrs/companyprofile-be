<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);


Route::get('home', [\App\Http\Controllers\API\HomeController::class, 'index']);

    Route::put('home/{id}', [\App\Http\Controllers\API\HomeController::class, 'update']);


Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);


    // Route::delete('posts/{id}', [\App\Http\Controllers\API\PostController::class, 'destroy']);

});
