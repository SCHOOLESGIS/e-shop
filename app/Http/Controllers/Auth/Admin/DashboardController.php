<?php
namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boutique;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;

class DashboardController extends Controller
{
    public function stats()
    {
        $stats= [];
        $boutiques = Boutique::with('produits.commandeItems')->get();
        $commandes = Commande::all()->groupBy('status');
        $produits = Produit::withCount('commandeItems')
        ->orderBy('items_count', 'desc')
        ->take(5)
        ->get();

        $clients = User::withCount('commandes')
        ->orderBy('commandes_count', 'desc')
        ->take(5)
        ->get();

        $ca = 0;
        foreach ($commandes['paid'] as $value) {
            $ca += $value->total;
        }

        $ca = 0;
        foreach ($commandes['paid'] as $value) {
            $ca += $value->total;
        }
        $revenusEspere = $ca;
        foreach ($commandes['cancelled'] as $value) {
            $revenusEspere += $value->total;
        }
        return view('back.admin.stats', compact(['boutiques', 'commandes', 'produits', 'clients', 'ca', 'revenusEspere']));
    }
}
