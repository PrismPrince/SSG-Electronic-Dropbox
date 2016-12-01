<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;

class UserController extends Controller
{
  public function index()
  {
    //
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    //
  }

  public function show(User $user)
  {
    return view('users.profile')->withUser(encrypt($user->id));
  }

  public function getUser(Request $user)
  {
    $user = User::findOrFail(decrypt($user->id));

    if (request()->ajax()) return response()->json([
      'fname' => $user->fname,
      'mname' => $user->mname,
      'lname' => $user->lname,
      'role' => $user->role,
    ]);
    else return abort(404);
  }

  public function edit(User $user)
  {
    //
  }

  public function update(Request $request, User $user)
  {
    //
  }

  public function destroy(User $user)
  {
    //
  }
}
