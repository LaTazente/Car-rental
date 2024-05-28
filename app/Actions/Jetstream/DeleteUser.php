<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;
/*Jetstream est un ensemble d'outils pour Laravel qui 
simplifie la création d'applications Web modernes en 
fournissant des fonctionnalités prêtes à l'emploi pour
la gestion des équipes, des profils d'utilisateur, de l'authentification, 
de la réinitialisation de mot de passe, et bien plus encore. Jetstream est 
conçu pour accélérer le développement de vos projets en vous fournissant une base solide et des composants d'interface utilisateur élégants.*/

class DeleteUser implements DeletesUsers
{
    /**
     * Supprimez l’utilisateur donné.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
