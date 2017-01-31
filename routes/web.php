<?php

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

Route::get('/', function () {
  return view('welcome');
});

Route::get('/home', 'HomeController@index');

// Auth routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password resets
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

Route::resource('user', 'UserController', [
 'except' => [
   'index',
   'create',
   'store'
 ]
]);
Route::get('profile/{user}', 'UserController@show')->name('user.show');
Route::get('/search', 'SearchController@showResults');

Route::get('/post/{post}', 'PostController@show');
Route::get('/poll/{poll}', 'PollController@show');
Route::get('/suggestion/{suggestion}', 'SuggestionController@show');

Route::get('/image/user/{user}', 'ImageController@userProfile');