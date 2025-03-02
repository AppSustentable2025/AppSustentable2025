<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\FirebaseException;
use Session;

class VerifyUser
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    return $next($request);
    //return redirect()->route('verify');
  }
}
