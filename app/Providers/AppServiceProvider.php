<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/*les providers dans Laravel sont des composants clés 
qui permettent d'enregistrer, de configurer et de gérer les services, 
les dépendances et la configuration de l'application. Ils jouent un rôle 
essentiel dans la mise en place de l'injection de dépendances, la gestion des services et l'extension du framework Laravel.*/

class AppServiceProvider extends ServiceProvider
{
    /**
     * Enregistrez tous les services d’application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
