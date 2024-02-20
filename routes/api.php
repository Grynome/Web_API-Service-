<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MVController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\MGController;

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

// Movies
Route::get('/data-movies', [MVController::class, 'index']);
    // Search With Param
    Route::get('/data-movies/search', [MVController::class, 'show']);
    // Store
    Route::post('store/data-movies', [MVController::class, 'store']);
    // Update
    Route::patch('patch/data-movies/{id}', [MVController::class, 'update']);
    // Delete
    Route::delete('destroy/data-movies/{id}', [MVController::class, 'destroy']);
// Store in 2 Table
    Route::post('store/multiple', [MVController::class, 'store_2_table']);
// Genres
Route::get('/data-genres', [GenresController::class, 'index']);
    // Search Data Genres with Params
    Route::get('/data-genres/search', [GenresController::class, 'show']);
    // Store Data
    Route::post('store/data-genres', [GenresController::class, 'store']);
    // Update
    Route::patch('patch/data-genres/{id}', [GenresController::class, 'update']);
    // Delete
    Route::delete('destroy/data-genres/{id}', [GenresController::class, 'destroy']);
// MOVIE GENRES
Route::get('data/Mov-Genres', [MGController::class, 'index']);
    // Store Data
    Route::post('store/Mov-Genres', [MGController::class, 'define']);
    // Update
    Route::patch('patch/Mov-Genres/{id}', [MGController::class, 'update']);
    // Delete
    Route::delete('destroy/Mov-Genres/{id}', [MGController::class, 'destroy']);

// FINAL VIEW MOVIE
Route::get('/movies', [MGController::class, 'view']);