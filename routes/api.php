<?php

use Illuminate\Http\Request;

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

Route::get('/user', 'HomeController@getUser');

Route::resource('/post', 'PostController', ['except' => ['create', 'show']]);
Route::resource('/poll', 'PollController', ['except' => ['create', 'show']]);
Route::get('/poll/{poll}/answers', 'PollController@getAnswers');
Route::get('/poll/{poll}/voters', 'PollController@getAllVoters');
Route::get('/answer/{answer}/voters', 'AnswerController@getVoters');
Route::post('/vote', 'PollController@vote');
Route::resource('/suggestion', 'SuggestionController', ['except' => ['create', 'show']]);
Route::post('/search', 'SearchController@getResults');
Route::post('/search/user', 'SearchController@getUsers');
Route::post('/search/post', 'SearchController@getPosts');
Route::post('/search/poll', 'SearchController@getPolls');
Route::post('/search/suggestion', 'SearchController@getSuggestions');