<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Suggestion;

class RedirectIfNotOwnStudentSuggestion
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (Auth::user()->role == 'student')
      if (Suggestion::find($request->route('suggestion'))->user_id != Auth::id())
        return redirect('home');

    return $next($request);
  }
}