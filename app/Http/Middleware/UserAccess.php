<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        $usertpe = auth()->user()->is_admin;
        switch ($usertpe) {
            case '1':
                $entered_user = 'admin';
                break;
            case '0':
                $entered_user = 'user';
                break;
            default:
                # code...
                break;
        }
        if ($entered_user == $userType) {
            return $next($request);
        }

        return response()->json(['You do not have permission to access for this page.']);
        /* return response()->view('errors.check-permission'); */
    }
}
