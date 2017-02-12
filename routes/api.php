<?php


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

Route::get('/auth/user', 'Auth\LoginController@getAuthUser');

Route::resource('/post', 'PostController', ['except' => ['create', 'show']]);

Route::resource('/poll', 'PollController', ['except' => ['create', 'show']]);
Route::get('/poll/{poll}/answers', 'PollController@getAnswers');
Route::get('/poll/{poll}/voters', 'PollController@getAllVoters');
Route::get('/answer/{answer}/voters', 'AnswerController@getVoters');

Route::post('/vote', 'PollController@vote');

Route::resource('/suggestion', 'SuggestionController', ['except' => ['create', 'show']]);
Route::get('/suggestion/{suggestion}/comment', 'SuggestionController@getComments');
Route::post('/suggestion/{suggestion}/comment', 'SuggestionController@storeComment');

Route::get('/search/{search}/dates', 'SearchController@getSearchDates');

Route::post('/search', 'SearchController@getResults');
Route::post('/search/user', 'SearchController@getUsers');

Route::post('/search/post', 'SearchController@getPosts');

Route::post('/search/poll', 'SearchController@getPolls');

Route::post('/search/suggestion', 'SearchController@getSuggestions');

Route::get('/post/{post}', 'PostController@getPost');
Route::get('/poll/{poll}', 'PollController@getPoll');
Route::get('/suggestion/{suggestion}', 'SuggestionController@getSuggestion');

Route::get('/profile/{user}', 'ProfileController@getUser');

Route::get('/user/{user}/post', 'ProfileController@getUserPosts');
Route::get('/user/{user}/poll', 'ProfileController@getUserPolls');
Route::get('/user/{user}/suggestion', 'ProfileController@getUserSuggestions');
Route::post('/user/{user}/role', 'ProfileController@changeRole');

Route::post('/image/user/upload', 'ImageController@uploadUserProfile');

Route::get('/account/email', 'AccountController@getEmail');

Route::post('/admin/user', 'AdminController@getUsers');
Route::post('/admin/user/status', 'AdminController@setUserStatus');
Route::get('/admin/user/code', 'UserRegistrationRequestController@index');
Route::post('/admin/user/code', 'UserRegistrationRequestController@store');
