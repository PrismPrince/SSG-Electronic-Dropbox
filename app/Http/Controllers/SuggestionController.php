<?php

namespace App\Http\Controllers;

use Auth;
use App\Suggestion;
use App\Comment;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['show']]);
    $this->middleware('auth', ['only' => ['show']]);
    $this->middleware('student.suggestion', ['only' => ['show']]);
  }

  public function index(Request $request)
  {
    if (Auth::guard('api')->user()->role == 'student')
      $suggestions = Suggestion::with('user')
                                ->where('user_id', Auth::guard('api')->id())
                                ->offset($request->skip)
                                ->limit($request->take)
                                ->orderBy('created_at', 'desc')
                                ->get();

    else $suggestions = Suggestion::with('user')
                                  ->offset($request->skip)
                                  ->limit($request->take)
                                  ->orderBy('created_at', 'desc')
                                  ->get();

    return response()->json($suggestions);
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $suggestion          = new Suggestion();

    $suggestion->user_id = Auth::guard('api')->id();
    $suggestion->title   = $request->title;
    $suggestion->direct  = $request->direct;
    $suggestion->message = $request->message;
    $suggestion->save();

    return response()->json(Suggestion::with('user')->find($suggestion->id));
  }

  public function show(Request $request, $suggestion)
  {
    Suggestion::with('user')->findOrFail($suggestion);

    return view('suggestions.show');
  }

  public function getSuggestion($suggestion)
  {
    return response()->json(Suggestion::with('user')->find($suggestion));
  }

  public function edit($suggestion)
  {
    return response()->json(Suggestion::with('user')->find($suggestion));
  }

  public function update(Request $request, $suggestion)
  {
    $suggestion          = Suggestion::with('user')->find($suggestion);

    $suggestion->title   = $request->title;
    $suggestion->direct  = $request->direct;
    $suggestion->message = $request->message;
    $suggestion->save();

    return response()->json($suggestion);
  }

  public function destroy($suggestion)
  {
    $suggestion = Suggestion::with('user')->find($suggestion);
    $suggestion->delete();

    return response()->json($suggestion);
  }

  public function getComments(Request $request, $suggestion)
  {
    return response()->json(Suggestion::find($suggestion)
                                      ->comments()
                                      ->with('user')
                                      ->offset($request->skip)
                                      ->limit($request->take)
                                      ->orderBy('created_at', 'desc')
                                      ->get());
  }

  public function storeComment(Request $request, $suggestion)
  {
    $comment = new Comment();

    $comment->suggestion_id = $suggestion;
    $comment->user_id = Auth::guard('api')->id();
    $comment->comment = $request->comment;
    $comment->save();

    return response()->json(Comment::with('user')->find($comment->id));
  }
}
