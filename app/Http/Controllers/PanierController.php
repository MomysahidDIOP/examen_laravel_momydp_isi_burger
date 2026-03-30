<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommandeConfirmation;

class PanierController extends Controller
{
    // Voir le panier
    public function index()
    {
        $panier = session()->get('panier', []);
        $total = 0;
        foreach ($panier as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        return view('panier.index', ['panier' => $panier, 'total' => $total]);
    }

    // Ajouter au panier
    public function ajouter(Request $request, $id)
    {
        $produit = Produit::find($id);
        $quantite = $request->input('quantite', 1);

        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            $panier[$id]['quantite'] += $quantite;
        } else {
            $panier[$id] = [
                'nom'      => $produit->nom,
                'prix'     => $produit->prix,
                'image'    => $produit->image,
                'quantite' => $quantite,
            ];
        }

        session()->put('panier', $panier);
        return back()->with('success', $produit->nom . ' ajouté au panier !');
    }

    // Modifier quantité
    public function modifier(Request $request, $id)
    {
        $panier = session()->get('panier', []);
        if (isset($panier[$id])) {
            $panier[$id]['quantite'] = $request->quantite;
            session()->put('panier', $panier);
        }
        return back()->with('success', 'Panier mis à jour');
    }

    // Supprimer un article
    public function supprimer($id)
    {
        $panier = session()->get('panier', []);
        unset($panier[$id]);
        session()->put('panier', $panier);
        return back()->with('delete', 'Produit retiré du panier');
    }

    // Vider le panier
    public function vider()
    {
        session()->forget('panier');
        return back()->with('delete', 'Panier vidé');
    }

    // Passer la commande depuis le panier
    public function commander()
    {
        $panier = session()->get('panier', []);

        if (empty($panier)) {
            return to_route('panier.index')->with('error', 'Votre panier est vide');
        }

        $commande = new Commande();
        $commande->user_id = Auth::id();
        $commande->statut  = 'en_attente';
        $commande->save();

        foreach ($panier as $produitId => $item) {
            $produit = Produit::find($produitId);

            $ligne = new LigneCommande();
            $ligne->commande_id   = $commande->id;
            $ligne->produit_id    = $produitId;
            $ligne->quantite      = $item['quantite'];
            $ligne->prix_unitaire = $item['prix'];
            $ligne->save();

            $produit->stock -= $item['quantite'];
            $produit->save();
        }

        // Vider le panier après commande
        session()->forget('panier');

        // Email confirmation
        Mail::to(Auth::user()->email)->send(new CommandeConfirmation($commande));

        return to_route('commande.mes_commandes')->with('success', 'Commande passée avec succès !');
    }
}
