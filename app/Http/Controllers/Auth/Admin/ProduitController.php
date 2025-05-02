<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;

use App\Models\Produit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;

use function PHPUnit\Framework\isNull;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(?int $boutiqueId = null)
    {
        $produits = $this->findProduit($boutiqueId);
        return view('back.admin.produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.admin.produits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {
        $data = $request->validated();
        $produit = new Produit();
        $produit->name = $data['name'];
        $produit->description = $data['description'];
        $produit->image = $data['image'];
        $produit->price = $data['price'];
        $produit->stock = $data['stock'];
        $produit->boutique_id = $data['boutique_id'];
        $produit->categorie_id = $data['categorie_id'];
        $produit->save();

        return redirect()->route('admin.produit.index', ['produits' => $this->findProduit($produit->boutique_id)])->with('success', 'Produit créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        $produit->load(['categorie', 'boutique']);
        return view('back.admin.produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return redirect()->route('admin.produit.edit', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
    {
        $data = $request->validated();
        $produit->name = $data['name'];
        $produit->description = $data['description'];
        $produit->image = $data['image'];
        $produit->price = $data['price'];
        $produit->stock = $data['stock'];
        $produit->categorie_id = $data['categorie_id'];
        $produit->update();

        return redirect()->route('admin.produit.index', ['produits' => $this->findProduit($produit->boutique_id)])->with('success', 'Produit mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $boutiqueId = $produit->boutique_id;
        $produit->delete();

        return redirect()->route('admin.produit.index')->with('success', 'Produit supprimé avec succès.');
    }

    //Not in controller
    public function findProduit(?int $boutiqueId = null)
    {
        if (isNull($boutiqueId)) {
            return Produit::paginate(10);
        }

        return Produit::where('boutique_id', $boutiqueId)->paginate(10);
    }
}
