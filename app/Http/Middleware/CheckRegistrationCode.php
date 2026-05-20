<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRegistrationCode
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('registration_code_verified') !== true) {
            return redirect()->route('login')
                ->withErrors(['error' => 'Invalid access to registration page.']);
        }

        return $next($request);
    }
}
