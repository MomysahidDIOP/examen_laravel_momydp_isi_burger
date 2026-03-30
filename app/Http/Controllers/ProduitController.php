<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with('categorie')->paginate(6);
        return view('produit.index', ['produits' => $produits]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produit = new Produit();
        $categories = Categorie::all();
        return view('produit.add', ['produit' => $produit, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nom'  => 'required|max:100',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image'  => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        }

        $produit = new Produit();
        $produit->nom  = $request['nom'];
        $produit->description  = $request['description'];
        $produit->prix = $request['prix'];
        $produit->stock  = $request['stock'];
        $produit->categorie_id = $request['categorie_id'];
        $produit->image = $imagePath;
        $produit->save();

        return to_route('produit.index')->with('success', 'Burger ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Produit::with('categorie')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produit    = $this->show($id);
        $categories = Categorie::all();
        return view('produit.add', ['produit' => $produit, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nom' => 'required|max:100',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image'  => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $produit = $this->show($id);

        if ($request->hasFile('image')) {
            $produit->image = $request->file('image')->store('produits', 'public');
        }

        $produit->nom = $request['nom'];
        $produit->description  = $request['description'];
        $produit->prix = $request['prix'];
        $produit->stock = $request['stock'];
        $produit->categorie_id = $request['categorie_id'];
        $produit->save();

        return to_route('produit.index')->with('success', 'Burger modifié avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $produit = $this->show($id);
        $produit->delete();
        return to_route('produit.index')->with('delete', 'Burger supprimé avec succès');
    }
    public function detail($id)
    {
        $produit = Produit::with('categorie')->find($id);
        return view('produit.detail', ['produit' => $produit]);
    }
}
