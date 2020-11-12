<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if (!session('login')) {
            return redirect('/')->with('message', 'Anda harus login terlebih dahulu!');
        }
        return $next($request);
    }
}
