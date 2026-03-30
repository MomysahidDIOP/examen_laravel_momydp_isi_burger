<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Routes PUBLIQUES
Route::get('/', [CommandeController::class, 'accueil'])->name('accueil');
Route::get('/menu/{id}', [ProduitController::class, 'detail'])->name('menu');



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CLIENT
    Route::get('/catalogue', [CommandeController::class, 'catalogue'])->name('catalogue');
    Route::post('/commande', [CommandeController::class, 'store'])->name('commande.store');
    Route::get('/mes_commandes', [CommandeController::class, 'mesCommandes'])->name('commande.mes_commandes');
    Route::get('/commandes/{id}/facture', [CommandeController::class, 'facturePdf'])->name('commande.facture');
    // PANIER
    Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter/{id}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    Route::patch('/panier/modifier/{id}', [PanierController::class, 'modifier'])->name('panier.modifier');
    Route::delete('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
    Route::delete('/panier/vider', [PanierController::class, 'vider'])->name('panier.vider');
    Route::post('/panier/commander', [PanierController::class, 'commander'])->name('panier.commander');
    // GESTIONNAIRE
    Route::middleware('role:gestionnaire')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::resource('categories', CategorieController::class)->names('categorie');
        Route::resource('produits', ProduitController::class)->names('produit');
        Route::get('/commandes', [CommandeController::class, 'index'])->name('commande.index');
        Route::patch('/commandes/{id}/statut', [CommandeController::class, 'updateStatut'])->name('commande.statut');
        Route::delete('/commandes/{id}', [CommandeController::class, 'destroy'])->name('commande.destroy');
        Route::post('/paiements', [PaiementController::class, 'store'])->name('paiement.store');
    });
});

require __DIR__.'/auth.php';
