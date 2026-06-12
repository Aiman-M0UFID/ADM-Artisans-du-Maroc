<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * AdminMiddleware
 * 
 * Vérifie que l'utilisateur connecté est bien un admin.
 * Si ce n'est pas le cas, il est redirigé avec un message d'erreur.
 */
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->type_user !== 'admin') {
            return redirect('/')->with('error', 'Accès refusé : vous n\'avez pas les droits administrateur.');
        }

        return $next($request);
    }
}
