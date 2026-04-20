<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserr
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $name = $request->route('name');

        $allowedUser = "anshu";

    if (strtolower($name) !== strtolower($allowedUser)) {
    abort(404, 'User not found');
    }
    return $next($request);
    }
}
