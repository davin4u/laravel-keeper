<?php

namespace App\Http\Middleware;

use Closure;
use App\RolesPermissions;

class CheckUserPermissions
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
      $route = $request->route()->getName();

      if (isset(RolesPermissions::$permissions[$route])) {
        $validRoles = RolesPermissions::$permissions[$route];

        if (!auth()->user()->hasRole($validRoles)) {
          return redirect('/home');
        }
      }

      return $next($request);
    }
}
