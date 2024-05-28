<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
/*Fortify est un package pour Laravel qui offre une solution complète 
pour l'authentification, l'inscription, la réinitialisation de mot de passe, 
et la gestion des sessions dans une application Laravel. Il est conçu pour simplifier 
la mise en place de ces fonctionnalités courantes d'authentification et de sécurité.*/

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validez et créez un nouvel utilisateur enregistré.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'job' => ['required'],
            'description' => ['required','max:255'],
            'role' => ['required'],
            'country' => ['required'],
            'city' => ['required'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'job' => $input['job'],
            'description' => $input['description'],
            'country' => $input['country'],
            'city' => $input['city'],
            'role' => $input['role'],
            'profile_photo_path' => 'https://via.placeholder.com/640x640.png/005588?text=people'.$input['name'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
