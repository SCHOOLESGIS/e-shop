<?php

namespace App\Http\Controllers\Auth\Admin;

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
        $commandes = Commande::where('user_id', $id)->with('boutique')->orderByDesc('created_at')->paginate(10);
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
        $commande->user_id = Auth::id();
        $commande->boutique_id = $data['boutique_id'];
        $commande->total = $data['total'];
        $commande->status = $data['status'] ?? 'pending';
        $commande->save();

        return redirect()->route('back.admin.commande.index')->with('success', 'Commande créée avec succès.');
    }

    public function show(Commande $commande)
    {
        $this->authorizeAccess($commande);
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
        $commande->boutique_id = $data['boutique_id'];
        $commande->total = $data['total'];
        $commande->status = $data['status'];
        $commande->save();

        return redirect()->route('admin.commande.index')->with('success', 'Commande mise à jour.');
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
        if ($commande->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à cette commande.');
        }
    }
}
