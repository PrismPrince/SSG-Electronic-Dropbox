<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\User;

class RedirectIfBothStudent
{
  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure                 $next
   *
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (Auth::user()->role == 'student') {
      $user = User::find($request->route('user'));
      if ($user->role == 'student' && $user->id != Auth::id()) {
        return redirect('/home');
      }
    }

    return $next($request);
  }
}
