<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminOrBusinessManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'BM') {
            return $next($request);
        }
        
        abort(404, 'Pelanggaran hak akses!');
    }
}
