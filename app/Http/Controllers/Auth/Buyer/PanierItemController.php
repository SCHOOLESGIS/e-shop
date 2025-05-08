<?php

namespace App\Http\Controllers\Auth\Buyer;

use App\Http\Controllers\Controller;

use App\Models\PanierItem;
use App\Models\Panier;
use App\Http\Requests\StorePanierItemRequest;
use App\Http\Requests\UpdatePanierItemRequest;
use App\Models\Produit;
use Illuminate\Support\Facades\Auth;

class PanierItemController extends Controller
{
    /**
     * Liste des articles dans le panier de l'utilisateur connecté.
     */
    public function index()
    {
        $panier = Panier::where('user_id', Auth::id())->with('items.produit')->first();
        return view('back.buyer.panier_items.index', compact('panier'));
    }

    /**
     * Stocke un nouvel article dans le panier.
     */
    public function store(StorePanierItemRequest $request)
    {
        $data = $request->validated();

        $panier = Panier::where('user_id', Auth::id())
                          ->first();

        if ($panier == null) {
            $panier = new Panier();
            $panier->user_id = Auth::id();
            $panier->save();
        }
        // dd($data);

        // Vérifie si le produit est déjà présent
        $item = PanierItem::with('produit.boutique')->where('panier_id', $panier->id)
                          ->where('produit_id', $data['produit_id'])
                          ->first();
        if ($item) {
            // Incrémente la quantité existante
            if ($data['decrease'] == 1) {
                $item->quantity -= $data['quantity'];
                $item->save();

                if ($item->quantity == 0) {
                    $item->delete();
                    return redirect()->route('home.panier')->with('success', 'Produit ajouté au panier.');
                }
            } else {
                $item->quantity += $data['quantity'];
                $item->save();
            }

            return redirect()->route('home.panier')->with('success', 'Produit ajouté au panier.');
        } else {
            // Crée un nouvel article
            $panier->items()->create([
                'produit_id' => $data['produit_id'],
                'quantity' => $data['quantity'],
            ]);
            // dd($panier->load('items'));
        }
        $produit = Produit::with('boutique')->where('id', $data['produit_id'])->first();
        return redirect()->route('boutique.show', ['boutique' => $produit->boutique->slug])->with('success', 'Produit ajouté au panier.');
    }

    /**
     * Affiche un article spécifique (optionnel).
     */
    public function show(PanierItem $panierItem)
    {
        $this->authorizeAccess($panierItem);
        return view('back.buyer.panier_items.show', compact('panierItem'));
    }

    /**
     * Affiche le formulaire d'édition (optionnel).
     */
    public function edit(PanierItem $panierItem)
    {
        $this->authorizeAccess($panierItem);
        return view('back.buyer.panier_items.edit', compact('panierItem'));
    }

    /**
     * Met à jour la quantité d'un article du panier.
     */
    public function update(UpdatePanierItemRequest $request, PanierItem $panierItem)
    {
        $this->authorizeAccess($panierItem);

        $data = $request->validated();
        $panierItem->quantity = $data['quantity'];
        $panierItem->save();

        return redirect()->route('back.buyer.panier_items.index')->with('success', 'Quantité mise à jour.');
    }

    /**
     * Supprime un article du panier.
     */
    public function destroy(PanierItem $panierItem)
    {
        $this->authorizeAccess($panierItem);
        $panierItem->delete();

        return redirect()->route('home.panier')->with('success', 'Article supprimé du panier.');
    }

    /**
     * Vérifie l'appartenance de l'article au panier de l'utilisateur.
     */
    private function authorizeAccess(PanierItem $panierItem)
    {
        if ($panierItem->panier->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à cet article du panier.');
        }
    }
}
