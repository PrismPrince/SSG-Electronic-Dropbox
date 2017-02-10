<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   */
  public function __construct()
  {
    $this->middleware('auth', ['only' => ['index']]);
    $this->middleware('auth:api', ['only' => ['getUser']]);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('home');
  }
}
