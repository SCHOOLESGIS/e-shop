<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Enum\PaginationEnum;
use App\Http\Controllers\Controller;

use App\Models\Commande;
use App\Http\Requests\StoreCommandeRequest;
use App\Http\Requests\UpdateCommandeRequest;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $commandes = Commande::with(['boutique', 'user'])->orderByDesc('created_at')->paginate(PaginationEnum::NUMBER);
        return view('back.admin.commandes.index', compact('commandes'));
    }

    public function create()
    {
        return view('back.admin.commandes.create');
    }

    public function store(StoreCommandeRequest $request)
    {
        $data = $request->validated();
        $commande = new Commande();
        $commande->status = $data['status'];
        $commande->update();

        return redirect()->route('back.admin.commande.index')->with('success', 'Commande créée avec succès.');
    }

    public function show(Commande $commande)
    {
        $this->authorizeAccess($commande);
        $commande->load('commandeItems');
        return view('back.admin.commandes.show', compact('commande'));
    }

    public function edit(Commande $commande)
    {
        $this->authorizeAccess($commande);
        return view('back.admin.commandes.edit', compact('commande'));
    }

    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        $this->authorizeAccess($commande);

        $data = $request->validated();
        $commande->status = $data['status'];
        $commande->update();

        return redirect()->route('admin.commande.show', ['commande' => $commande->id])->with('success', 'Commande mise à jour.');
    }

    public function destroy(Commande $commande)
    {
        $this->authorizeAccess($commande);
        $commande->delete();
        return redirect()->route('admin.commande.index')->with('success', 'Commande supprimée.');
    }

    /**
     * Vérifie que l'utilisateur authentifié est bien propriétaire de la commande.
     */
    private function authorizeAccess(Commande $commande)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Accès non autorisé à cette commande.');
        }
    }
}
