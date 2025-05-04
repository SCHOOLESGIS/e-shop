<?php

namespace App\Http\Controllers\Auth\Seller;

use App\Enum\PaginationEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCommandeRequest;
use App\Models\Commande;
use App\Models\Boutique;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $role = 'buyer';
        $boutiqueIds = Boutique::where('user_id', $id)->pluck('id');

        $commandes = Commande::whereIn('boutique_id', $boutiqueIds)
            ->whereHas('user', function($query) use ($role) {
                return $query->where('role', $role);
            })
            ->with('boutique')
            ->orderByDesc('created_at')
            ->paginate(PaginationEnum::NUMBER);

        return view('back.seller.commandes.index', compact('commandes'));
    }

    public function show(Commande $commande)
    {
        return view('back.seller.commandes.show', compact('commande'));
    }

    public function create(Commande $commande)
    {
        $id = Auth::id();

        $boutiqueIds = Boutique::where('user_id', $id)->pluck('id');
        $role = 'buyer';
        $acheteursIds = Commande::whereIn('boutique_id', $boutiqueIds)
            ->whereHas('user', function($query) use ($role) {
                return $query->where('role', $role);
            })
            ->pluck('user_id')
            ->unique();

        $acheteurs = User::whereIn('id', $acheteursIds)->paginate(PaginationEnum::NUMBER);

        return view('back.seller.commandes.create', compact('acheteurs'));
    }

    public function update(UpdateCommandeRequest $request, Commande $commande)
    {
        $data = $request->validated();
        $commande->status = $data['status'];
        $commande->update();

        return redirect()->route('seller.commande.index')->with('success', 'Commande livré.');
    }
}
