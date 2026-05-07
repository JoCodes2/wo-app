<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            switch ($user->role) {
                case 'admin':
                    return redirect('/dashboard')
                        ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
                case 'wo':
                    return redirect('/dashboard')
                        ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
                case 'user':
                    return redirect('/profile-saya')
                        ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
                default:
                    return redirect('/')
                        ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        return $next($request);
    }
}
