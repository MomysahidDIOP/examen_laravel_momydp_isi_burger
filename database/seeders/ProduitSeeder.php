<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Produit;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        // Catégories
        $burgers   = Categorie::create(['nom' => 'Burgers']);
        $boissons  = Categorie::create(['nom' => 'Boissons']);
        $desserts  = Categorie::create(['nom' => 'Desserts']);

        // Burgers
        Produit::create([
            'nom'          => 'Big ISI Burger',
            'description'  => 'Double steak, cheddar, salade, tomate',
            'prix'         => 3500,
            'stock'        => 20,
            'categorie_id' => $burgers->id,
        ]);
        Produit::create([
            'nom'          => 'Cheese Burger',
            'description'  => 'Steak, cheddar fondu, cornichons',
            'prix'         => 2500,
            'stock'        => 15,
            'categorie_id' => $burgers->id,
        ]);
        Produit::create([
            'nom'          => 'Spicy Burger',
            'description'  => 'Steak épicé, jalapeños, sauce pimentée',
            'prix'         => 3000,
            'stock'        => 10,
            'categorie_id' => $burgers->id,
        ]);
        Produit::create([
            'nom'          => 'Chicken Burger',
            'description'  => 'Poulet croustillant, mayo, salade',
            'prix'         => 2800,
            'stock'        => 12,
            'categorie_id' => $burgers->id,
        ]);

        // Boissons
        Produit::create([
            'nom'          => 'Coca Cola',
            'description'  => 'Boisson gazeuse 33cl',
            'prix'         => 500,
            'stock'        => 50,
            'categorie_id' => $boissons->id,
        ]);
        Produit::create([
            'nom'          => 'Jus d\'orange',
            'description'  => 'Jus frais pressé',
            'prix'         => 800,
            'stock'        => 30,
            'categorie_id' => $boissons->id,
        ]);

        // Desserts
        Produit::create([
            'nom'          => 'Brownie',
            'description'  => 'Brownie chocolat maison',
            'prix'         => 1000,
            'stock'        => 20,
            'categorie_id' => $desserts->id,
        ]);
        Produit::create([
            'nom'          => 'Glace vanille',
            'description'  => '2 boules vanille',
            'prix'         => 700,
            'stock'        => 25,
            'categorie_id' => $desserts->id,
        ]);
    }
}
