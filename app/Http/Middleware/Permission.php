<?php

namespace App\Http\Middleware;

use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param permission
     * @return mixed
     */
    public function handle($request, Closure $next, ... $permissions)
    {
        foreach ($permissions as $permission) {
            if(!auth()->user()->hasPermissionTo($permission)) {

                abort(404);
            }
        }

        return $next($request);
    }
}
