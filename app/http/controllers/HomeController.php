<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getUser',],]);
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

    public function getUser(Request $request)
    {
        $user = User::findOrFail(decrypt($request->id));
        return response()->json([
            'id' => $user->id,
            'fname' => $user->fname,
            'mname' => $user->mname,
            'lname' => $user->lname,
            'role' => $user->role,
        ]);
    }
}
