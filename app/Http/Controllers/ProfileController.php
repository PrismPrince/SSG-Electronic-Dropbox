<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['showProfile']]);
    $this->middleware('auth', ['only' => ['showProfile']]);
  }

  public function showProfile($user)
  {
    return view('profile')->withProfile(User::findOrFail($user));
  }

  public function getUser($user)
  {
    return response()->json(User::findOrFail($user));
  }

  public function getUserPosts(Request $request, $user)
  {
    return User::findOrFail($user)->posts()->with('user')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get();
  }

  public function getUserPolls(Request $request, $user)
  {
    return User::findOrFail($user)->polls()->with('user')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get();
  }

  public function getUserSuggestions(Request $request, $user)
  {
    return User::findOrFail($user)->suggestions()->with('user')->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get();
  }

  public function changeRole(Request $request, $user)
  {
    $user       = User::findOrFail($user);
    $user->role = $request->role;
    $user->save();

    return response()->json($user);
  }
}
