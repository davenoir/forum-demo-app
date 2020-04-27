<?php

namespace App\Http\Middleware;

use Closure;
use App\Topic;
use Illuminate\Support\Facades\Auth;

class ControlCrud
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

        if(Auth::check())
        {
            if((Auth::user()->role_id == 2) || (Auth::user()->role_id == 1))
            {
                return $next($request);
            }
                return redirect()->back()->with('error', 'You are not authorized to modify or delete this post');
        }

        return redirect('/');

    }
}
