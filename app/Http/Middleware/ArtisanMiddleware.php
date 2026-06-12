<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * ArtisanMiddleware
 * 
 * Vérifie que l'utilisateur connecté est bien un artisan.
 * Un client ou admin ne peut pas accéder à l'espace artisan.
 */
class ArtisanMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || Auth::user()->type_user !== 'artisan') {
            return redirect('/')->with('error', 'Accès refusé : cet espace est réservé aux artisans.');
        }

        return $next($request);
    }
}
