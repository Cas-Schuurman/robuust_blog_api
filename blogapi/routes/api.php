<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Show all blogs
Route::get('/blogs', 'App\Http\Controllers\BlogController@index');

//Create new blog
Route::post('/blogs', 'App\Http\Controllers\BlogController@store');

//CRUD blogs show update and delete
Route::get('/blogs/{blog}', 'App\Http\Controllers\BlogController@show');
Route::put('/blogs/{blog}', 'App\Http\Controllers\BlogController@update');
Route::delete('/blogs/{blog}', 'App\Http\Controllers\BlogController@delete');

//show all authors
Route::post('/authors', 'App\Http\Controllers\AuthorController@store');

//Create new author
Route::post('/authors', 'App\Http\Controllers\AuthorController@store');

//CRUD author show update and delete
Route::get('/authors/{author}', 'App\Http\Controllers\AuthorController@show');
Route::put('/authors/{author}', 'App\Http\Controllers\AuthorController@update');
Route::delete('/authors/{author}', 'App\Http\Controllers\AuthorController@delete');