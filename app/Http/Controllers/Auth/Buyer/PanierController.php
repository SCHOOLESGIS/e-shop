<?php

namespace App\Http\Controllers\Auth\Buyer;

use App\Http\Controllers\Controller;

use App\Models\Panier;
use App\Http\Requests\StorePanierRequest;
use App\Http\Requests\UpdatePanierRequest;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    /**
     * Affiche le panier de l'utilisateur connecté.
     */
    public function index()
    {
        $panier = Panier::where('user_id', Auth::id())->first();

        return view('back.buyer.panier.index', compact('panier'));
    }

    /**
     * Montre un formulaire (si besoin) pour créer un panier.
     */
    public function create()
    {
        return view('back.buyer.panier.create');
    }

    /**
     * Création ou récupération d'un panier pour l'utilisateur connecté.
     */
    public function store(StorePanierRequest $request)
    {
        $existing = Panier::where('user_id', Auth::id())->first();

        if ($existing) {
            return redirect()->route('panier.index')->with('info', 'Un panier existe déjà.');
        }

        $panier = new Panier();
        $panier->user_id = Auth::id();
        $panier->save();

        return redirect()->route('panier.index')->with('success', 'Panier créé avec succès.');
    }

    /**
     * Affiche un panier spécifique (protégé).
     */
    public function show(Panier $panier)
    {
        $this->authorizeAccess($panier);
        return view('back.buyer.panier.show', compact('panier'));
    }

    /**
     * Affiche le formulaire d'édition du panier.
     */
    public function edit(Panier $panier)
    {
        $this->authorizeAccess($panier);
        return view('back.buyer.panier.edit', compact('panier'));
    }

    /**
     * Met à jour les infos du panier (si nécessaire).
     */
    public function update(UpdatePanierRequest $request, Panier $panier)
    {
        $this->authorizeAccess($panier);
        // Si des champs additionnels sont présents, les mettre à jour ici
        $panier->save();

        return redirect()->route('panier.index')->with('success', 'Panier mis à jour.');
    }

    /**
     * Supprime un panier (ex: lors d'un reset).
     */
    public function destroy(Panier $panier)
    {
        $this->authorizeAccess($panier);
        $panier->delete();

        return redirect()->route('panier.index')->with('success', 'Panier supprimé.');
    }

    /**
     * Sécurise l'accès au panier : un utilisateur ne peut voir que le sien.
     */
    private function authorizeAccess(Panier $panier)
    {
        if ($panier->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à ce panier.');
        }
    }
}
