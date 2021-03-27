<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSeniorOfficer
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
        if (auth()->user()->role != 'SO') {
            abort(404, 'Pelanggaran hak akses!');
        }

        return $next($request);
    }
}
