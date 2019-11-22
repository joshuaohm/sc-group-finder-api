<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

  public function handle($request, Closure $next, ...$guards){

    if ($request->cookie('scgf-token')) {
      $request->headers->set('Authorization', 'Bearer ' . $request->cookie('scgf-token'));
    }

    $this->authenticate($request, $guards);

    return $next($request);
  }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
