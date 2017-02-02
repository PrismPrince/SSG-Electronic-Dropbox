<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth', ['only' => ['showUsers', 'getCode']]);
    $this->middleware('auth:api', ['only' => ['getUsers', 'setUserStatus']]);
    $this->middleware('admin');
  }

  public function getCode()
  {
    return view('admin.code');
  }

  public function showUsers()
  {
    return view('admin.users');
  }

  public function getUsers(Request $request)
  {
    $users = [];
    foreach (User::withTrashed()->offset($request->skip)->limit($request->take)->orderBy('created_at', 'desc')->get() as $user) {
      $users[] = [
        'id' => $user->id,
        'fname' => $user->fname,
        'lname' => $user->lname,
        'email' => $user->email,
        'role' => $user->role,
        'created_at' => $user->created_at,
        'deleted_at' => $user->deleted_at,
      ];
    }

    return response()->json($users);
  }

  public function setUserStatus(Request $request)
  {
    if ($request->status == 'activate') {
      $user = User::withTrashed()->find($request->id);
      $user->posts()->restore();
      $user->polls()->restore();
      $user->suggestions()->restore();
      $user->restore();
    }
    if ($request->status == 'deactivate') {
      $user = User::withTrashed()->find($request->id);
      $user->posts()->delete();
      $user->polls()->delete();
      $user->suggestions()->delete();
      $user->delete();
    }
    return response()->json([
      'id' => $user->id,
      'fname' => $user->fname,
      'lname' => $user->lname,
      'email' => $user->email,
      'role' => $user->role,
      'created_at' => $user->created_at,
      'deleted_at' => $user->deleted_at,
    ]);
  }
}
