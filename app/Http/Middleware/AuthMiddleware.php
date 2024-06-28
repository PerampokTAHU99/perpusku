<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $userData = $request->session()->get('userData');

        if (!$userData) {
            return redirect()->route('auth.login')->with(
                [
                    'status' => "ERROR",
                    'message' => 'Silahkan login terlebih dahulu'
                ]
            );
        }

        return $next($request);
    }
}
