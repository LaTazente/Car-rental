<?php

namespace App\Http\Livewire;

use App\Models\Demande;
use Livewire\Component;

class FeedbackBell extends Component
{
    public function render()
    {

        //Alerter le partenaire pour qu’il commente le client
        $Clientdemandes = Demande::where([
            ['user_id', '=', auth()->user()->id],
            ['feedbackArticle', '=', 'pending'],
            ['state', '=', 'done'],
        ])->get();

        //Alerter le client pour qu’il commente le partenaire
        $PartnerDemandes = [];

        $demandesP = Demande::where([
            ['feedbackClient', '=', 'pending'],
            ['state', '=', 'done'],
        ])->get();

        foreach ($demandesP as $demande) {
            if ($demande->annoncedispo->annonce->user->id == auth()->user()->id);
            array_push($PartnerDemandes, $demande);
        }

        if (auth()->user()->role == 1)
            $demandes = $PartnerDemandes;
        else
            $demandes = $Clientdemandes;


        return view('livewire.feedback-bell', [
            'demandes' => $demandes,
        ]);
    }
}
