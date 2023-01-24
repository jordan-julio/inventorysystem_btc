<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;
use Closure;

class MemberMiddleware
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
        if ($request->user() && $request->user()->type == 'member' || $request->user() && $request->user()->type == 'super_admin' || $request->user() && $request->user()->type == 'admin')
        {
            
            return $next($request);
        } 
        return new Response(view('unauthorized'));
    }
}
