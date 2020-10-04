<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {
  Route::get('/', 'HomeController@index')->name('dashboard');

  // Projects
  Route::resource('admin/projects', 'Admin\\ProjectsController');

  // Contact Us
  Route::get('admin/contacts', 'Admin\\ContactsController@index')->name('contacts.index');
  Route::delete('admin/contacts/{id}', 'Admin\\ContactsController@destroy')->name('contacts.destroy');

  // Reviews
  Route::get('admin/reviews', 'Admin\\ReviewController@index')->name('reviews.index');
  Route::delete('admin/reviews/{id}', 'Admin\\ReviewController@destroy')->name('reviews.destroy');

  // NewsLetter
  Route::resource('admin/news-letter', 'Admin\\NewsLetterController');

  // Clients
  Route::resource('admin/clients', 'Admin\\ClientsController');


  // Route::get('/home', 'HomeController@index')->name('home');

});

Auth::routes();
Route::get('login/{provider}' , 'Auth\\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback' , 'Auth\\SocialAccountController@handleProviderCallback');
