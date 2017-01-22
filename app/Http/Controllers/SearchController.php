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
    $this->middleware('auth:api');
  }

  public function getResult(Request $request)
  {
    // get 3 posts
    $users = User::searchName($request->key)->orderBy('fname')->limit(3)->get();
    $posts = Post::search('title', $request->key)->orderBy('created_at', 'desc')->limit(3)->get();
    $polls = Poll::search('title', $request->key)->orderBy('created_at', 'desc')->limit(3)->get();
    $suggestions = Suggestion::search('title', $request->key)->orderBy('created_at', 'desc')->limit(3)->get();

    return response()->json([
      'users' => $users,
      'posts' => $posts,
      'polls' => $polls,
      'suggestions' => $suggestions,
    ]);

    // get 3 polls
    // get 3 suggestions
  }
}
