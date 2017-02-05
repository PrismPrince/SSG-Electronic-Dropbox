<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRegistrationRequest;
use Validator;

class UserRegistrationRequestController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
    $this->middleware('admin');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // return $request->key;
    if ($request->key != 'null')
      return response()->json(UserRegistrationRequest::where('id', 'LIKE', '%' . $request->key . '%')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get());
    else
      return response()->json(UserRegistrationRequest::offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'new_student_id' => 'required|integer|max:9999999|min:1000000|unique:user_registration_requests,id'
    ]);

    $user = new UserRegistrationRequest();
    $user->id = $request->new_student_id;
    $user->code = strtoupper(substr(md5(time()),0,5) . '-' . substr(md5($request->new_student_id),0,5) . '-' . str_random(5));
    $user->save();

    return response()->json($user);
  }
}
