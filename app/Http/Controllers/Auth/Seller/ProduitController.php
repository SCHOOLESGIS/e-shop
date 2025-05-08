<?php

namespace App\Http\Controllers\Auth\seller;

use App\Http\Controllers\Controller;

use App\Models\Produit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Models\Boutique;
use App\Models\Categorie;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boutiques = Boutique::with('produits')->where('user_id', Auth::id())->get();
        $produits = $boutiques->flatMap(function ($boutique) {
            return $boutique->produits;
        });

        $produits = new LengthAwarePaginator($produits, $produits->count(), 10, 1, ['path' => '/seller/produits/']);

        return view('back.seller.produits.index', compact(['produits']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $boutiques = Boutique::all()->where('user_id', Auth::id());
        $categories = Categorie::all();
        return view('back.seller.produits.create', compact(['boutiques', 'categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduitRequest $request)
    {

        $imagePath = $request->file('image')?->store('produits', 'public');

        $data = $request->validated();
        $produit = new Produit();
        $produit->name = $data['name'];
        $produit->description = $data['description'];
        $produit->image = $imagePath;
        $produit->price = $data['price'];
        $produit->stock = $data['stock'];
        $produit->boutique_id = $data['boutique_id'];
        $produit->categorie_id = $data['categorie_id'];
        $produit->save();

        return redirect()->route('seller.produit.index', ['produits' => $this->findProduit($produit->boutique_id)])->with('success', 'Produit créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        return view('back.seller.produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        $boutiques = Boutique::all();
        $categories = Categorie::all();
        return view('back.seller.produits.edit', compact(['boutiques', 'categories', 'produit']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduitRequest $request, Produit $produit)
    {
        if ($request->hasFile('image')) {
            // Suppression de l’ancienne image si elle existe
            if ($produit->image && Storage::disk('public')->exists($produit->image)) {
                Storage::disk('public')->delete($produit->image);
            }

            $imagePath = $request->file('image')->store('produits', 'public');
        } else {
            $imagePath = $produit->image;
        }
        $data = $request->validated();
        $produit->name = $data['name'];
        $produit->description = $data['description'];
        $produit->image = $imagePath;
        $produit->price = $data['price'];
        $produit->stock = $data['stock'];
        $produit->categorie_id = $data['categorie_id'];
        $produit->update();

        return redirect()->route('seller.produit.index', ['produits' => $this->findProduit($produit->boutique_id)])->with('success', 'Produit mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $boutiqueId = $produit->boutique_id;
        $produit->delete();

        return redirect()->route('seller.produit.index')->with('success', 'Produit supprimé avec succès.');
    }

    //Not in controller
    public function findProduit(?int $boutiqueId = null)
    {
        $user = Auth::user();

        $boutiques = $user->boutiques;
        // dd($boutiques);
        if ($boutiqueId) {
            // Si un ID de boutique est fourni, filtrer les produits de cette boutique
            return Produit::where('boutique_id', $boutiqueId)
                               ->whereIn('boutique_id', $boutiques->pluck('id'))
                               ->paginate(10);
        } else {
            // Sinon, récupérer tous les produits des boutiques du vendeur
            return Produit::whereIn('boutique_id', $boutiques->pluck('id'))
                               ->paginate(10);
        }
    }
}
