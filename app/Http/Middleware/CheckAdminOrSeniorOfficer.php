<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminOrSeniorOfficer
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
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'SO') {
            return $next($request);
        }
        
        abort(404, 'Pelanggaran hak akses!');
    }
}
