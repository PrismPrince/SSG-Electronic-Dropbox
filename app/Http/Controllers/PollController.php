<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Poll;
use App\Answer;
use Auth;

class PollController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  public function index(Request $request)
  {
    return response()->json(Poll::with('user')->with('answers.users')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get());
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
    $poll->type = $request->type;

    if (Carbon::now() > Carbon::parse($request->end)) {
      $poll->status = 'expired';
    } else if (Carbon::now() < Carbon::parse($request->start)) {
      $poll->status = 'pending';
    } else if (Carbon::now() >= Carbon::parse($request->start) && Carbon::now() <= Carbon::parse($request->end)) {
      $poll->status = 'active';
    }
    
    $poll->save();

    $answers = [];

    foreach ($request->answers as $key => $answer) {
      $answers[$key] = new Answer();
      $answers[$key]->answer = $answer['answer'];
    }

    $poll->answers()->saveMany($answers);

    return response()->json(Poll::with('user')->with('answers.users')->find($poll->id));
  }

  public function show($id)
  {
    //
  }

  public function edit($poll)
  {
    return response()->json(Poll::with('user')->with('answers')->find($poll));
  }

  public function update(Request $request, $poll)
  {
    $id = $poll;

    $poll = Poll::with('user')->with('answers')->find($id);
    $poll->title = $request->title;
    $poll->desc = $request->desc;
    $poll->start = Carbon::parse($request->start)->toDateTimeString();
    $poll->end = Carbon::parse($request->end)->toDateTimeString();
    $poll->type = $request->type;

    if (Carbon::now() > Carbon::parse($request->end)) {
      $poll->status = 'expired';
    } else if (Carbon::now() < Carbon::parse($request->start)) {
      $poll->status = 'pending';
    } else if (Carbon::now() >= Carbon::parse($request->start) && Carbon::now() <= Carbon::parse($request->end)) {
      $poll->status = 'active';
    }

    $oldAnswers = array_pluck($poll->answers()->get()->toArray(), 'id'); // [1, 2, 3]

    $modAnswers = array_pluck($request->answers, 'id'); // [0, 2, 3, null, null]

    $dropAnswers = array_diff($oldAnswers, $modAnswers); // [1 => 2, 2 => 3]

    $answers = [];

    foreach ($request->answers as $key => $answer) {
      if ($answer['id'] == null) {
        $answers[$key] = new Answer();
        $answers[$key]->answer = $answer['answer'];
      } else {
        $answers[$key] = Answer::find($answer['id']);
        $answers[$key]->answer = $answer['answer'];
      }
    }

    foreach ($dropAnswers as $ans) {
      $poll->answers()->find($ans)->delete();
    }


    $poll->answers()->saveMany($answers);

    $poll->save();

    return response()->json(Poll::with('user')->with('answers.users')->find($id));
  }

  public function destroy($poll)
  {
    $poll = Poll::with('user')->with('answers')->find($poll);
    $poll->delete();

    return response()->json($poll);
  }

  public function vote(Request $request)
  {
    $answer = Answer::find($request->answer);

    if ($answer->poll->type == 'once') {
      foreach ($answer->poll->answers()->get() as $ans) {
        if ($ans->users()->get()->contains(Auth::guard('api')->id())) {
          $ans->users()->toggle(Auth::guard('api')->id());
        }
      }
      $answer->users()->toggle(Auth::guard('api')->id());
    } else if ($answer->poll->type == 'multi') {
      $answer->users()->toggle(Auth::guard('api')->id());
    }

    // $user = Auth::guard('api')->user();
    // $user->answers()->toggle($request->answer);
    return response()->json(Poll::with('user')->with('answers.users')->find($answer->poll->id));
  }
}
