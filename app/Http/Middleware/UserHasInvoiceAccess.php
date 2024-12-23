<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserHasInvoiceAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->hasAccessTo($request->route()->parameter('invoice')->id) == false)
        {
            return abort(403, 'You are not allowed to access this invoice');
        }

        return $next($request);
    }
}
