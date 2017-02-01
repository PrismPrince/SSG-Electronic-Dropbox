<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function showAccountSetting()
  {
    return view('account.index');
  }

  public function showChangePassword()
  {
    return view('account.password');
  }

}
