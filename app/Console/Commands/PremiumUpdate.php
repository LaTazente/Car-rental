<?php

namespace App\Console\Commands;

use App\Models\Annonce;
use App\Models\Demande;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Notification;
class PremiumUpdate extends Command
/*premium:update est utilisée pour automatiser des tâches 
de mise à jour liées aux annonces, aux demandes et aux notifications 
dans votre application Laravel. Elle effectue des opérations de gestion 
des annonces "premium", de refus de demandes en attente, et de mise à jour 
des demandes acceptées en fonction des dates de réservation. Elle simplifie 
la gestion de ces processus en les automatisant à l'aide d'Artisan.*/

{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'premium:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //premium 
        $annonces = Annonce::where('premium' ,'=','on')->get();
        foreach($annonces as $annonce){
            if($annonce->premium_duration > 1){
                $annonce->update(['premium_duration' => $annonce->premium_duration-1 ]);
            }
            if($annonce->premium_duration == 1)
            $annonce->update(
                ['premium_duration' => 0 ,
                'premium' => "off" ],
            );
        }   

        
        //refuse demande 
        $demandes = Demande::where('state','=','pending')->get();
        foreach($demandes as $demande){
            if($demande->reservation_date < date('Y-m-d')){
                $demande->update(['state' => 'refused']);
                $demande->annoncedispo->update(['stat'=>'1']);
                Notification::create([
                    'demande_id' => $demande->id,
                    'message' => 'No response. Your request was canceled automatically',
                ]);
            }
        }

        //UPDATE DISPONIBILITE
        $demandes = Demande::where('state','=','accepted')->get();
        foreach($demandes as $demande){
            if($demande->reservation_date < date('Y-m-d')){
                $demande->update(['state' => 'done']);
                $demande->annoncedispo->update(['stat'=>'1']);
            }
        }
            

        return 0;
    }
}
