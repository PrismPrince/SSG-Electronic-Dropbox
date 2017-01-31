<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;
use App\Poll;
use App\Suggestion;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth:api', ['only' => ['getResults']]);
    $this->middleware('auth', ['only' => ['showResults']]);
  }

  public function getResults(Request $request)
  {
    $users = User::searchName($request->key)->orderBy('fname')->orderBy('lname')->limit(3)->get();
    $posts = Post::searchTitle($request->key)->orderBy('created_at', 'desc')->limit(3)->get();
    $polls = Poll::searchTitle($request->key)->orderBy('created_at', 'desc')->limit(3)->get();
    if (Auth::guard('api')->user()->role == 'student')
      $suggestions = Suggestion::searchTitle($request->key)->where('user_id', Auth::guard('api')->id())->orderBy('created_at', 'desc')->limit(3)->get();
    else
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
    if ($request->month != null)
      $posts = Post::search($request->key)
        ->whereBetween('created_at', [
          Carbon::create($request->year, $request->month, 1, 12, 0, 0)->startOfMonth(),
          Carbon::create($request->year, $request->month, 1, 12, 0, 0)->endOfMonth()
        ])
        ->orderBy('created_at', 'desc')
        ->offset($request->skip)
        ->limit($request->take)
        ->get();

    elseif ($request->year != null)
      $posts = Post::search($request->key)
        ->whereBetween('created_at', [
          Carbon::create($request->year, 1, 1, 12, 0, 0)->startOfYear(),
          Carbon::create($request->year, 1, 1, 12, 0, 0)->endOfYear()
        ])
        ->orderBy('created_at', 'desc')
        ->offset($request->skip)
        ->limit($request->take)
        ->get();

    else
      $posts = Post::search($request->key)->orderBy('created_at', 'desc')->offset($request->skip)->limit($request->take)->get();

    return response()->json($posts);
  }

  public function getPolls(Request $request)
  {
    if ($request->month != null)
      $polls = Poll::search($request->key)
        ->whereBetween('created_at', [
          Carbon::create($request->year, $request->month, 1, 12, 0, 0)->startOfMonth(),
          Carbon::create($request->year, $request->month, 1, 12, 0, 0)->endOfMonth()
        ])
        ->orderBy('created_at', 'desc')
        ->offset($request->skip)
        ->limit($request->take)
        ->get();

    elseif ($request->year != null)
      $polls = Poll::search($request->key)
        ->whereBetween('created_at', [
          Carbon::create($request->year, 1, 1, 12, 0, 0)->startOfYear(),
          Carbon::create($request->year, 1, 1, 12, 0, 0)->endOfYear()
        ])
        ->orderBy('created_at', 'desc')
        ->offset($request->skip)
        ->limit($request->take)
        ->get();

    else
      $polls = Poll::search($request->key)->orderBy('created_at', 'desc')->offset($request->skip)->limit($request->take)->get();

    return response()->json($polls);
  }

  public function getSuggestions(Request $request)
  {
    if ($request->month != null)
      if (Auth::guard('api')->user()->role == 'student')
        $suggestions = Suggestion::search($request->key)
          ->whereBetween('created_at', [
            Carbon::create($request->year, $request->month, 1, 12, 0, 0)->startOfMonth(),
            Carbon::create($request->year, $request->month, 1, 12, 0, 0)->endOfMonth()
          ])
          ->where('user_id', Auth::guard('api')->id())
          ->orderBy('created_at', 'desc')
          ->offset($request->skip)
          ->limit($request->take)
          ->get();
      else
        $suggestions = Suggestion::search($request->key)
          ->whereBetween('created_at', [
            Carbon::create($request->year, $request->month, 1, 12, 0, 0)->startOfMonth(),
            Carbon::create($request->year, $request->month, 1, 12, 0, 0)->endOfMonth()
          ])
          ->orderBy('created_at', 'desc')
          ->offset($request->skip)
          ->limit($request->take)
          ->get();

    elseif ($request->year != null)
      if (Auth::guard('api')->user()->role == 'student')
        $suggestions = Suggestion::search($request->key)
          ->whereBetween('created_at', [
            Carbon::create($request->year, 1, 1, 12, 0, 0)->startOfYear(),
            Carbon::create($request->year, 1, 1, 12, 0, 0)->endOfYear()
          ])
          ->where('user_id', Auth::guard('api')->id())
          ->orderBy('created_at', 'desc')
          ->offset($request->skip)
          ->limit($request->take)
          ->get();
      else
        $suggestions = Suggestion::search($request->key)
          ->whereBetween('created_at', [
            Carbon::create($request->year, 1, 1, 12, 0, 0)->startOfYear(),
            Carbon::create($request->year, 1, 1, 12, 0, 0)->endOfYear()
          ])
          ->orderBy('created_at', 'desc')
          ->offset($request->skip)
          ->limit($request->take)
          ->get();

    else
      if (Auth::guard('api')->user()->role == 'student')
        $suggestions = Suggestion::search($request->key)->where('user_id', Auth::guard('api')->id())->orderBy('created_at', 'desc')->offset($request->skip)->limit($request->take)->get();
      else
        $suggestions = Suggestion::search($request->key)->orderBy('created_at', 'desc')->offset($request->skip)->limit($request->take)->get();

    return response()->json($suggestions);
  }

  public function getSearchDates(Request $request, $search)
  {
    if ($search == 'post') $searches = Post::select('created_at')->orderBy('created_at', 'desc')->get();
    if ($search == 'poll') $searches = Poll::select('created_at')->orderBy('created_at', 'desc')->get();
    if ($search == 'suggestion') $searches = Suggestion::select('created_at')->orderBy('created_at', 'desc')->get();

    $dates = [];
    $collect = [];
    $final = [];

    foreach ($searches as $search) {

      // date of the post
      $date = $search->created_at;

      // store year and month of the post
      $dates[] = ['year' => $date->year, 'month' => $date->month];

    }

    $newDates = collect($dates)->unique(function ($i) {

      return $i['year'].$i['month'];

    })->values();

    for ( $i = 0; $i < count($newDates); $i++ ) {
      $collect[$newDates[$i]['year']][] = $newDates[$i]['month'];
    }

    list($year, $months) = array_divide($collect);

    for ( $i = 0; $i < count($year); $i++ ) {
      $final[] = ['year' => $year[$i], 'months' => $months[$i]];
    }

    return response()->json($final);
  }
}
