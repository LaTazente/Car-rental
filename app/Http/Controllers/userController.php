<?php

namespace App\Http\Controllers;

use App\Models\feedbackClient;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    /*
    cette méthode show récupère un utilisateur spécifique en fonction
     de son ID depuis la base de données, puis renvoie une vue 'profile' 
     pour afficher les détails de l'utilisateur. En outre, elle calcule le nombre 
     total d'étoiles attribuées à cet utilisateur à partir d'une autre table (probablement des
    commentaires ou des évaluations) et transmet ce nombre à la vue. Cela permet d'afficher le profil de l'utilisateur avec le nombre total d'étoiles qu'il a reçues.*/
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('profile',[
            'user' => $user,
            'stars_count' =>feedbackClient::where('client_id','=',$user->id)->sum('nb_stars'),
        ]);
    }
}


           


    
