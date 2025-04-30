<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.admin.categorie.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('back.admin.categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        $data = $request->validated();
        $categorie = new Categorie();
        $categorie->name = $data['name'];
        $categorie->boutique_id = $data['boutique_id'];
        $categorie->save();

        return view('back.admin.categorie.create')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        return view('back.admin.categorie.show', compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        return view('back.admin.categorie.edit', compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $data = $request->validated();
        $categorie->name = $data['name'];
        $categorie->boutique_id = $data['boutique_id'];
        $categorie->update();

        return view('back.admin.categorie.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return view('back.admin.categorie.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
