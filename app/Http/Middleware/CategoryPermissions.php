<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CategoryPermissions
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
        
        //protect the whole controller/route
        if (Auth::user()->hasRole(['Normal Employee', 'Department Head'])) {
            return $next($request);
        }


        //go more granular and protect by the different permissions??
        if ($request->is('task-categories')) {
            if (!Auth::user()->hasPermissionTo('create task category')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        // if ($request->is('posts/*/edit')) {
        //     if (!Auth::user()->hasPermissionTo('Edit Post')) {
        //         abort('401');
        //     } else {
        //         return $next($request);
        //     }
        // }

        // if ($request->isMethod('Delete')) {
        //     if (!Auth::user()->hasPermissionTo('Delete Post')) {
        //         abort('401');
        //     } else {
        //         return $next($request);
        //     }
        // }

        return $next($request);
    }
}
