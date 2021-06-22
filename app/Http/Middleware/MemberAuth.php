<?php

namespace App\Http\Middleware;

use Closure;

class MemberAuth
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
         if (!auth()->guard('member')->check()) {
            return redirect(route('member.login'));
        }
        return $next($request);
    }
}
