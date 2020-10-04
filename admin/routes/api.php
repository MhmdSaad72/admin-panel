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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Projects
Route::resource('projects', 'API\\ProjectsController');

// Contact Us
Route::post('/contact-us', 'API\\ContactsController@store');

// Reviews
Route::post('/reviews', 'API\\ReviewController@store');

// NewsLetter
Route::get('/news-letter', 'API\\NewsLetterController@index');
Route::get('/news-letter/{id}', 'API\\NewsLetterController@show');

// Clients
Route::get('/clients', 'API\\ClientsController@index');
Route::get('/clients/{id}', 'API\\ClientsController@show');
