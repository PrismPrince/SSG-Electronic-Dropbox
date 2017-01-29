<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class UserController extends Controller
{
  public function show($user)
  {
    return view('users.profile')->withProfile(User::findOrFail($user));
  }

  public function getUser($user)
  {
    return response()->json(User::find($user));
  }

  public function getUserPosts(Request $request, $user)
  {
    return User::find($user)->posts()->with('user')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get();
  }

  public function getUserPolls(Request $request, $user)
  {
    return User::find($user)->polls()->with('user')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get();
  }

  public function getUserSuggestions(Request $request, $user)
  {
    return User::find($user)->suggestions()->with('user')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get();
  }
}
