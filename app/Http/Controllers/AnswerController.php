<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Answer;

class AnswerController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  public function getVoters($answers)
  {
    return response()->json(Answer::find($answers)->users()->get());
  }
}
