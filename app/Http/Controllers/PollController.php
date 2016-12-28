<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use Auth;

class PollController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  public function index(Request $request)
  {
    return response()->json(Poll::with('user')->with('answers')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get());
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $poll = new Poll();
    $poll->user_id = Auth::guard('api')->id();
    $poll->title = $request->title;
    $poll->desc = $request->desc;
    $poll->start = Carbon::parse($request->start)->toDateTimeString();
    $poll->end = Carbon::parse($request->end)->toDateTimeString();
    $poll->save();

    return response()->json(Poll::with('user')->find($poll->id));
  }

  public function show($id)
  {
    //
  }

  public function edit($poll)
  {
    return response()->json(Poll::with('user')->find($poll));
  }

  public function update(Request $request, $poll)
  {
    $poll = Poll::with('user')->find($poll);
    $poll->title = $request->title;
    $poll->desc = $request->desc;
    $poll->start = Carbon::parse($request->start)->toDateTimeString();
    $poll->end = Carbon::parse($request->end)->toDateTimeString();
    $poll->save();

    return response()->json($poll);
  }

  public function destroy($poll)
  {
    $poll = Poll::with('user')->find($poll);
    $poll->delete();

    return response()->json($poll);
  }
}
