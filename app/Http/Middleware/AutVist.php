<?php

namespace App\Http\Middleware;

use Closure;

class AutVist
{
    public function handle($request, Closure $next)
    {
        // Verificar si el token está almacenado en la sesión
        if (!session()->has('token')) {
            // Si no hay token en la sesión, redirigir al usuario al login
            return redirect()->route('login');
        }

        // Continuar con la solicitud si el usuario está autenticado
        return $next($request);
    }
}
