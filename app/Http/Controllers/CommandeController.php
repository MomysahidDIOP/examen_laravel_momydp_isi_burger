<?php

namespace App\Http\Controllers;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommandeConfirmation;
use Barryvdh\DomPDF\Facade\Pdf;
class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $commandes = Commande::with('user', 'ligneCommandes.produit')->paginate(10);
        return view('commande.index', ['commandes' => $commandes]);
    }
    public function accueil(Request $request)
    {
        $query = Produit::where('archive', false)->where('stock', '>', 0)->with('categorie');

        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%' . $request->nom . '%');
        }
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        $produits = $query->paginate(6);
        $categories = \App\Models\Categorie::withCount('produits')->get();
        return view('accueil', ['produits' => $produits, 'categories' => $categories]);
    }


    public function catalogue(Request $request)
    {
        $query = Produit::where('archive', false)->where('stock', '>', 0);

        // Filtres
        if ($request->filled('nom')) {
            $query->where('nom', 'like', '%' . $request->nom . '%');
        }
        if ($request->filled('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }

        $produits = $query->paginate(6);
        return view('commande.catalogue', ['produits' => $produits]);
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
    // Client  passer une commande
    public function store(Request $request)
    {
        $request->validate([
            'produits' => 'required|array',
            'produits.*' => 'exists:produits,id',
            'quantites' => 'required|array',
        ]);

        $commande = new Commande();
        $commande->user_id = Auth::id();
        $commande->statut  = 'en_attente';
        $commande->save();
        Mail::to(Auth::user()->email)->send(new CommandeConfirmation($commande));

        foreach ($request->produits as $index => $produitId) {
            $produit  = Produit::find($produitId);
            $quantite = $request->quantites[$index];

            $ligne = new LigneCommande();
            $ligne->commande_id  = $commande->id;
            $ligne->produit_id  = $produitId;
            $ligne->quantite = $quantite;
            $ligne->prix_unitaire = $produit->prix;
            $ligne->save();

            // Decrémenter le stock
            $produit->stock -= $quantite;
            $produit->save();
        }
        return to_route('commande.mes_commandes')->with('success', 'Commande passee avec succès');

    }

    // Client avex ses propres commandes
    public function mesCommandes()
    {
        $commandes = Commande::with('ligneCommandes.produit')
            ->where('user_id', Auth::id())
            ->paginate(10);
        return view('commande.mes-commandes', ['commandes' => $commandes]);
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
    public function updateStatut(Request $request, string $id)
    {

        $request->validate([
            'statut' => 'required|in:en_attente,en_preparation,prete,payee',
        ]);

        $commande = Commande::with('user', 'ligneCommandes.produit', 'paiement')->find($id);
        $commande->statut = $request->statut;
        $commande->save();

        // Envoyer email avec facture PDF quand statut = "prete"
        if ($request->statut === 'prete') {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.facture', ['commande' => $commande]);

            \Illuminate\Support\Facades\Mail::to($commande->user->email)
                ->send(new \App\Mail\CommandeConfirmation($commande));
        }

        return to_route('commande.index')->with('success', 'Statut mis à jour');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commande = Commande::find($id);
        $commande->delete();
        return to_route('commande.index')->with('delete', 'Commande annulée');
    }
    public function facturePdf($id)
    {
        $commande = Commande::with('user', 'ligneCommandes.produit', 'paiement')->find($id);
        $pdf = Pdf::loadView('pdf.facture', ['commande' => $commande]);
        return $pdf->download('facture-commande-'.$id.'.pdf');
    }

}
