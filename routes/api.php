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
Route::group(['middleware' => ['cors']], function () {

    Route::post('/auth/login', 'TokenController@login');
    Route::post('/user/is-a-valid-email', 'UserController@isAValidEmail');

    Route::get('/auth/refresh', 'TokenController@refreshToken');
    Route::get('/auth/logout', 'TokenController@logout');
    Route::post('/writer', 'WriterController@store');
    Route::post('/publisher', 'PublisherController@store');
    Route::post('/reader', 'ReaderController@store');

    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::post('/book', 'BookController@store');
        Route::put('/book', 'BookController@update');
        Route::get('/book/show/{book_id}', 'BookController@show');
        Route::get('/book/list-new-books', 'BookController@listNewBooks');
        Route::delete('/book/delete/{book_id}', 'BookController@destroy');
        Route::get('/book/list-my-books', 'BookController@listMyBooks');
        Route::get('/book/change-draft/{book_id}', 'BookController@changeDraft');

        Route::post('/book/change-status', 'BookController@changeStatus');

        Route::get('/book/add-to-my-list/{book_id}', 'BookController@addToMyList');
        Route::delete('/book/remove-from-my-list/{book_id}', 'BookController@removeFromMyList');

        Route::post('/chapter/{book_id}', 'ChapterController@store');
        Route::get('/chapter/show/{chapter_id}', 'ChapterController@show');
        Route::get('/chapter/chapters-of-book/{book_id}', 'ChapterController@listChaptersOfBook');
        Route::put('/chapter', 'ChapterController@update');
        Route::delete('/chapter/{chapter_id}', 'ChapterController@destroy');

        Route::post('/opinion/{book_id}', 'OpinionController@store');
        Route::get('/opinion/show/{opinion_id}', 'OpinionController@show');
        Route::get('/opinion/opinions-of-book/{book_id}', 'OpinionController@listOpinionsOfBook');
        Route::put('/opinion', 'OpinionController@update');
        Route::delete('/opinion/{opinion_id}', 'OpinionController@destroy');


    });
});
