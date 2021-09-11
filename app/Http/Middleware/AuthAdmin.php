<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class AuthAdmin
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
        if(Auth::check()){
            $user = Auth::user();
            if($user->type == 'admin'){
                return $next($request);
            }else{
                abort(401);
            }
        }else{
            return redirect('/')->send();
        }
    }
}
