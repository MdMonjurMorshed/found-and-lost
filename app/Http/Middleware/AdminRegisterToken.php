<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRegisterToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $code = $request->input('code');
        $admin_code=env('ADMIN_CODE');
        if ($code != $admin_code)
        {
            return redirect()->back()->with('error','Code did not matched');
        }

        // dd($code);
        return $next($request);
    }
}
