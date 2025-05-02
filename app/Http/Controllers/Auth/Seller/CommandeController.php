<?php

namespace App\Http\Controllers\Auth\Seller;

use App\Http\Controllers\Controller;

use App\Models\Commande;
use App\Models\Boutique;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        $boutiqueIds = Boutique::where('user_id', $id)->pluck('id');

        $commandes = Commande::whereIn('boutique_id', $boutiqueIds)
            ->with('boutique')
            ->orderByDesc('created_at')
            ->paginate(10);

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

        $acheteursIds = Commande::whereIn('boutique_id', $boutiqueIds)
            ->pluck('user_id')
            ->unique();

        $acheteurs = User::whereIn('id', $acheteursIds)->paginate(10);

        return view('back.seller.commandes.create', compact('acheteurs'));
    }
}
