<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
// use Illuminate\Support\Facades\Auth;

class IsDepartmentAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     return $next($request);
    // }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::all()->count();
        if (!($user == 1)) {
            // if (auth()->user()->hasPermissionTo('Administer departments functions')) {
            //     abort('401');
            // }
        }
        
        return $next($request);
    }
}
