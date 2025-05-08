<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Boutique;
use App\Enum\PaginationEnum;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::paginate(PaginationEnum::NUMBER);
        return view('back.admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $boutiques = Boutique::all();
        return view('back.admin.categories.create', compact('boutiques'));
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

        return redirect()->route('admin.categorie.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        return view('back.admin.categories.show', compact(['categorie']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        $boutiques = Boutique::all();
        return view('back.admin.categories.edit', compact(['categorie', 'boutiques']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $data = $request->validated();
        $categorie->name = $data['name'];
        $categorie->boutique_id = $data['boutique_id'];
        $categorie->save();

        return redirect()->route('admin.categorie.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect()->route('admin.categorie.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
