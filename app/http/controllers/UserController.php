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
