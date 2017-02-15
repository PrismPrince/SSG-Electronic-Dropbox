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

// User Account
Route::get('account', 'AccountController@showAccountSetting');
Route::get('account/password', 'AccountController@showChangePassword');
Route::post('account/password', 'Auth\ResetPasswordController@changePassword');
Route::get('account/email', 'AccountController@showChangeEmail');
Route::patch('account/email', 'AccountController@setEmail');
Route::get('account/name', 'AccountController@showChangeName');
Route::patch('account/name', 'AccountController@setName');

// Administrator
Route::get('admin/user', 'AdminController@showUsers');
Route::get('admin/user/code', 'AdminController@showUsersCode');

// Password resets
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

Route::get('profile/{user}', 'ProfileController@showProfile');

Route::get('/search', 'SearchController@showResults');

Route::get('/post/{post}', 'PostController@show');
Route::get('/poll/{poll}', 'PollController@show');
Route::get('/suggestion/{suggestion}', 'SuggestionController@show');

Route::get('/image/user/{user}', 'ImageController@userProfile');
Route::get('/image/post/{image}', 'ImageController@postImage');
