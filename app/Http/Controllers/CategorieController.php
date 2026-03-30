<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {$categories = Categorie::all();
        return view('categorie.index', ['categories' => $categories]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorie = new Categorie();
        return view('categorie.add', ['categorie' => $categorie]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:categories|max:50',
        ]);

        $categorie = new Categorie();
        $categorie->nom = $request['nom'];
        $categorie->save();

        return to_route('categorie.index')->with('success', 'Catégorie créée avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Categorie::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $categorie = $this->show($id);
        return view('categorie.add', ['categorie' => $categorie]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'nom' => 'required|max:50',
        ]);

        $categorie = $this->show($id);
        $categorie->nom = $request['nom'];
        $categorie->save();

        return to_route('categorie.index')->with('success', 'Catégorie modifiee avec succes');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categorie = $this->show($id);
        $categorie->delete();
        return to_route('categorie.index')->with('delete', 'Catégorie supprimee avec succes');
    }
}
