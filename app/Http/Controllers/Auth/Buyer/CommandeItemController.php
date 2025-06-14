<?php

namespace App\Http\Controllers\Auth\Buyer;

use App\Http\Controllers\Controller;

use App\Models\CommandeItem;
use App\Http\Requests\StoreCommandeItemRequest;
use App\Http\Requests\UpdateCommandeItemRequest;
use Illuminate\Support\Facades\Auth;

class CommandeItemController extends Controller
{
    public function index()
    {
        $commandeItems = CommandeItem::whereHas('commande', function ($query) {
            $query->where('user_id', Auth::id());
        })->with(['produit', 'commande']);
    }

    public function create()
    {
        return view('back.buyer.commande_items.create');
    }

    public function store(StoreCommandeItemRequest $request)
    {
        $data = $request->validated();

        $commandeItem = new CommandeItem();
        $commandeItem->commande_id = $data['commande_id'];
        $commandeItem->produit_id = $data['produit_id'];
        $commandeItem->quantity = $data['quantity'];
        $commandeItem->unit_price = $data['unit_price'];
        $commandeItem->save();
    }

    public function show(CommandeItem $commandeItem)
    {
        $this->authorizeAccess($commandeItem);
    }

    public function edit(CommandeItem $commandeItem)
    {
        $this->authorizeAccess($commandeItem);
    }

    public function update(UpdateCommandeItemRequest $request, CommandeItem $commandeItem)
    {
        $this->authorizeAccess($commandeItem);

        $data = $request->validated();
        $commandeItem->produit_id = $data['produit_id'];
        $commandeItem->quantity = $data['quantity'];
        $commandeItem->unit_price = $data['unit_price'];
        $commandeItem->save();
    }

    public function destroy(CommandeItem $commandeItem)
    {
        $this->authorizeAccess($commandeItem);
        $commandeItem->delete();
    }

    /**
     * Protection d'accès par propriétaire de commande liée.
     */
    private function authorizeAccess(CommandeItem $commandeItem)
    {
        if ($commandeItem->commande->user_id !== Auth::id()) {
            abort(403, 'Accès interdit à cet article de commande.');
        }
    }
}
