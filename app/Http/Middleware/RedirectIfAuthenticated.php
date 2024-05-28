<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    /*Dans la fonction handle, le middleware vérifie si l'utilisateur est déjà authentifié
    pour l'un des gardes spécifiés. Il parcourt la liste des gardes ($guards) fournie en argument.
    Si l'utilisateur est authentifié pour l'un des gardes, le middleware redirige l'utilisateur vers
    la page d'accueil de l'application en utilisant la classe RouteServiceProvider et la constante 
    RouteServiceProvider::HOME. Cela signifie que si un utilisateur authentifié essaie d'accéder à une page 
    où l'authentification n'est pas autorisée (par exemple, la page de connexion), il sera redirigé vers la page d'accueil.*/
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
