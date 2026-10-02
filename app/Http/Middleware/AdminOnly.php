<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | Utilisateur non connecté
        |--------------------------------------------------------------------------
        */
        if (!$request->user()) {
            return redirect()->route('login');
        }

        /*
        |--------------------------------------------------------------------------
        | Utilisateur connecté mais non administrateur
        |--------------------------------------------------------------------------
        |
        | isAdmin() accepte :
        | - admin
        | - superadmin
        |
        */

        if (!$request->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
