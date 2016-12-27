<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suggestion;
use Auth;

class SuggestionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  public function index(Request $request)
  {
    return response()->json(Suggestion::with('user')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get());
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $suggestion = new Suggestion();
    $suggestion->user_id = Auth::guard('api')->id();
    $suggestion->title = $request->title;
    $suggestion->direct = $request->direct;
    $suggestion->message = $request->message;
    $suggestion->save();

    return response()->json(Suggestion::with('user')->find($suggestion->id));
  }

  public function show($id)
  {
    //
  }

  public function edit($suggestion)
  {
    return response()->json(Suggestion::with('user')->find($suggestion));
  }

  public function update(Request $request, $suggestion)
  {
    $suggestion = Suggestion::with('user')->find($suggestion);
    $suggestion->title = $request->title;
    $suggestion->direct = $request->direct;
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
}
