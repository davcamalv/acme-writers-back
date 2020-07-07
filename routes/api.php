<?php

use App\Http\Controllers\LibroController;
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

Route::post('/auth/login', 'TokenController@login');
Route::post('/auth/refresh', 'TokenController@refreshToken');
Route::get('/auth/logout', 'TokenController@logout');
Route::post('/writer/register', 'WriterController@store');
Route::post('/publisher/register', 'PublisherController@store');
Route::post('/reader/register', 'ReaderController@store');

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('/book/create', 'BookController@store');
});
