<?php

use App\Http\Controllers\articleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\feedbackController;
use App\Http\Controllers\partnerController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
}); //envoie la vue (template) appelée 'welcome'


/*Dans Laravel, le middleware est un mécanisme essentiel qui permet d'intercepter les requêtes HTTP entrantes et de prendre des actions en fonction de certaines conditions.
Les middlewares agissent comme une couche intermédiaire entre le serveur web et les routes de l'application Laravel.
Ils sont utilisés pour effectuer diverses tâches, telles que l'authentification, l'autorisation, la validation des données, 
la gestion des sessions, le journalisation, et bien d'autres.*/

//Ceci est un groupe de routes qui est placé sous le middleware "auth". Le middleware est un mécanisme dans Laravel qui permet d'effectuer des tâches de filtrage ou de traitement avant que la requête atteigne la route proprement dite. En l'occurrence, le middleware "auth" vérifie si l'utilisateur est authentifié avant d'accéder aux routes contenues dans ce groupe.
Route::group(["middleware" => "auth"], function () { //Les middlewares d'authentification permettent de vérifier si un utilisateur est connecté et authentifié. Si l'utilisateur n'est pas authentifié, il peut être redirigé vers la page de connexion.

    Route::get('articles', [articleController::class, 'index'])->name('articles'); //Cette route est associée à la méthode index du contrôleur articleController et se norme articles

    Route::get('article/{id}', [articleController::class, 'show']); //Cette route est associée à la méthode show du contrôleur articleController et Elle affiche généralement un article spécifique en fonction de l'ID passé en paramètre.

    //Route::post('article/add', [articleController::class, 'store']); //Cette route est associée à la méthode store du contrôleur articleController et Elle est utilisée pour ajouter de nouveaux articles en utilisant une méthode POST.

    Route::get('/partner', [partnerController::class, 'index'])->name('partner'); //Cette route est associée à la méthode index du contrôleur partnerController et se norme partner

    Route::get('/addAnnonce', [partnerController::class, 'create'])->name('addAnnonce'); //Cette route est associée à la méthode create du contrôleur partnerController et se norme addAnnonce et Elle est utilisée pour afficher un formulaire pour ajouter une annonce.

    Route::post('/addAnnonce/add', [partnerController::class, 'store']); //Cette route est associée à la méthode store du contrôleur partnerController et Elle est utilisée pour traiter l'ajout d'une annonce en utilisant une méthode POST.

    Route::get('/profile/{id}', [userController::class, 'show']); //Cette route est associée à la méthode show du contrôleur userController et  Elle affiche probablement le profil d'un utilisateur spécifique en fonction de l'ID passé en paramètre.

    Route::get('/feedback/{demande_id}/{id}', [feedbackController::class, 'create']); // Cette route est associée à la méthode create du contrôleur feedbackController. Elle semble être liée à la création de commentaires ou de feedback pour une demande particulière.

    Route::post('/feedback/add', [feedbackController::class, 'store']); //Cette route est associée à la méthode store du contrôleur feedbackController. Elle est utilisée pour traiter l'ajout de commentaires en utilisant une méthode POST.

    Route::get('/dashboard', function () {
        return view('articles/index');
    }); //Cette route renvoie une vue appelée 'articles/index' qui pourrait être une page de tableau de bord pour les utilisateurs connectés.
});
