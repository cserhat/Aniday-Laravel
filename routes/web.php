<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\AdminAnimeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminEpisodeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Partie Client */
Route::resource('/', AnimeController::class );
Route::resource('/episode', EpisodeController::class );
Route::get('/watch/{slug}/{anime_id}', [EpisodeController::class, 'show']);

Route::resource('/anime', AnimeController::class);

Route::post('anime/watched', [AnimeController::class, 'addToWatched']);
Route::delete('anime/watched/delete/{anime_id}',[AnimeController::class, 'deletewatch']);
/*  Partie Connection */

Route::get('/login', [AuthController::class,'show']);
Route::post('/postlogin', [AuthController::class,'login'])->name('/postlogin');
Route::post('/postsignup', [AuthController::class, 'signupsave'])->name('/postsignup');
Route::get('signout', [AuthController::class, 'signout'])->name('signout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

/* Partie Admin */
Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin/anime', [AdminAnimeController::class, 'index']);
    Route::delete('/admin/anime/{anime_id}', [AdminAnimeController::class, 'destroy']);
    Route::get('/admin/episode', [AdminEpisodeController::class,'index']);
    Route::get('/admin/anime-add', [AnimeController::class,'create']);
    Route::get('/admin/episode-add', [EpisodeController::class,'create']);
    Route::put('/admin/update-anime/{anime_id}', [AdminAnimeController::class,'update'])->name('admin.update-anime');
    Route::get('/admin/anime/edit/{id}', [AdminAnimeController::class, 'edit']);
    Route::get('/admin/api', [TestController::class, 'show']);
    Route::post('admin/api-search', [TestController::class, 'store'])->name('api-search');
});

