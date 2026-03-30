<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Commande;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $commande = Commande::find($request->commande_id);

        // Une commande ne peut être payée qu'une seule fois
        if ($commande->paiement) {
            return back()->with('error', 'Cette commande est déjà payée');
        }

        $paiement = new Paiement();
        $paiement->commande_id   = $commande->id;
        $paiement->montant       = $request->montant;
        $paiement->date_paiement = now();
        $paiement->save();

        // Mettre à jour le statut de la commande
        $commande->statut = 'payee';
        $commande->save();

        return to_route('commande.index')->with('success', 'Paiement enregistré avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
