<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Poll;
use App\Suggestion;

class SearchController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth:api', ['only' => ['getResult']]);
    $this->middleware('auth', ['only' => ['showResult']]);
  }

  public function getResults(Request $request)
  {
    $users = User::searchName($request->key)->orderBy('fname')->orderBy('lname')->limit(3)->get();
    $posts = Post::searchTitle($request->key)->orderBy('created_at', 'desc')->limit(3)->get();
    $polls = Poll::searchTitle($request->key)->orderBy('created_at', 'desc')->limit(3)->get();
    $suggestions = Suggestion::searchTitle($request->key)->orderBy('created_at', 'desc')->limit(3)->get();

    return response()->json([
      'users' => $users,
      'posts' => $posts,
      'polls' => $polls,
      'suggestions' => $suggestions,
    ]);
  }

  public function showResults(Request $request)
  {
    return view('search');
  }

  public function getUsers(Request $request)
  {
    $users = User::searchName($request->key)->orderBy('fname')->orderBy('lname')->offset($request->skip)->limit($request->take)->get();

    return response()->json($users);
  }

  public function getPosts(Request $request)
  {
    $posts = Post::search($request->key)->orderBy('created_at', 'desc')->offset($request->skip)->limit($request->take)->get();

    return response()->json($posts);
  }

  public function getPolls(Request $request)
  {
    $polls = Poll::search($request->key)->orderBy('created_at', 'desc')->offset($request->skip)->limit($request->take)->get();

    return response()->json($polls);
  }

  public function getSuggestions(Request $request)
  {
    $suggestions = Suggestion::search($request->key)->orderBy('created_at', 'desc')->offset($request->skip)->limit($request->take)->get();

    return response()->json($suggestions);
  }
}
