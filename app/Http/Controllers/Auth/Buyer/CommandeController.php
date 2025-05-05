<?php

namespace App\Http\Controllers\Auth\Buyer;

use App\Enum\PaginationEnum;
use App\Http\Controllers\Controller;

use App\Models\Commande;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\CommandeItem;
use App\Models\Panier;
use App\Models\PanierItem;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $commandes = Commande::where('user_id', $id)->paginate(PaginationEnum::NUMBER);
        return view('back.buyer.commandes.index', compact('commandes'));
    }

    public function create()
    {
        return view('back.buyer.commandes.create');
    }

    public function store(StoreCommandeRequest $request)
    {
        $data = $request->validated();
        $id = Auth::id();
        $commande = new Commande();
        $commande->user_id = Auth::id();
        $commande->boutique_id = $data['boutique_id'];
        $commande->total = $data['total'];
        $commande->status = $data['status'] ?? 'pending';
        $commande->save();

        $panierItems = PanierItem::with(['produit.boutique', 'panier'])
        ->whereHas('produit', function ($query) use ($data) {
            $query->where('boutique_id', $data['boutique_id']);
        })
        ->whereHas('panier', function ($query) use ($id) {
            $query->where('user_id', $id);
        })
        ->get();

        foreach ($panierItems as $item) {
            $commandeItem = new CommandeItem();
            $commandeItem->produit_id = $item->produit_id;
            $commandeItem->commande_id = $commande->id;
            $commandeItem->quantity = $item->quantity;
            $commandeItem->unit_price = $item->quantity * $item->produit->price;
            $commandeItem->save();

            $panier_item = PanierItem::all()->findOrFail($item->id);
            $panier_item->delete();
        }



        return redirect()->route('buyer.commande.index')->with('success', 'Commande créée avec succès.');
    }

    public function show(Commande $commande)
    {
        $this->authorizeAccess($commande);
        $commande->load(['commandeItems.produit', 'boutique']);
        return view('back.buyer.commandes.show', compact('commande'));
    }

    public function edit(Commande $commande)
    {
        $this->authorizeAccess($commande);
        return view('back.buyer.commandes.edit', compact('commande'));
    }

    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        $this->authorizeAccess($commande);

        $data = $request->validated();
        $commande->status = $data['status'];
        $commande->save();

        return redirect()->route('buyer.commande.index')->with('success', 'Commande mise à jour.');
    }

    public function destroy(Commande $commande)
    {
        $this->authorizeAccess($commande);
        $commande->delete();
        return redirect()->route('buyer.commande.index')->with('success', 'Commande supprimée.');
    }

    /**
     * Vérifie que l'utilisateur authentifié est bien propriétaire de la commande.
     */
    private function authorizeAccess(Commande $commande)
    {
        if ($commande->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à cette commande.');
        }
    }
}
