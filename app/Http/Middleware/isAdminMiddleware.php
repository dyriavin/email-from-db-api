<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class isAdminMiddleware
 * @package App\Http\Middleware
 */
class isAdminMiddleware
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
        if (!auth()->user()->is_admin){
            return abort(403);
        }

        return $next($request);
    }
}
