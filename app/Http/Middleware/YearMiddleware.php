<?php

namespace App\Http\Middleware;

use App\Models\AnneeScolaire;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class YearMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->school_year) {
            return $next($request);
        }

        $request['activated_school_year'] = 1;
        return $next($request);
    }
}
