<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//default route
Route::get('/', function () {
    return response()->json([
        'message' => 'Music-Album API',
    ]);
});

//albums routes
Route::get('/albums', [App\Http\Controllers\AlbumController::class, 'getAlbums']);
Route::get('/albums/{id}', [App\Http\Controllers\AlbumController::class, 'getAlbum']);
Route::post('/albums', [App\Http\Controllers\AlbumController::class, 'createAlbum']);
Route::patch('/albums/{id}', [App\Http\Controllers\AlbumController::class, 'updateAlbum']);
Route::delete('/albums/{id}', [App\Http\Controllers\AlbumController::class, 'deleteAlbum']);

//songs routes
Route::get('/songs', [App\Http\Controllers\SongController::class, 'getSongs']);
Route::get('/songs/{id}', [App\Http\Controllers\SongController::class, 'getSong']);
Route::post('/songs', [App\Http\Controllers\SongController::class, 'createSong']);
Route::patch('/songs/{id}', [App\Http\Controllers\SongController::class, 'updateSong']);
Route::delete('/songs/{id}', [App\Http\Controllers\SongController::class, 'deleteSong']);

Route::get('/albums/{id}/songs', [App\Http\Controllers\AlbumController::class, 'getAlbumSongs']);