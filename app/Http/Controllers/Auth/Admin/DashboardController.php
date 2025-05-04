<?php
namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boutique;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\Produit;
use App\Models\User;

class DashboardController extends Controller
{
    public function stats()
    {
        $stats= [];
        $boutiques = Boutique::with('produits.commandeItems')->get();
        $commandes = Commande::all();
        $commandesParStatus = Commande::all()->groupBy('status');
        $produits = Produit::withCount('commandeItems')
        ->orderBy('items_count', 'desc')
        ->take(5)
        ->get();

        $clients = User::withCount('commandes')
        ->where('role', 'buyer')
        ->orderBy('commandes_count', 'desc')
        ->take(5)
        ->get();

        $categories = Categorie::all();
        $paniers = Panier::all();

        $ca = 0;
        foreach ($commandesParStatus['paid'] as $value) {
            $ca += $value->total;
        }

        $ca = 0;
        foreach ($commandesParStatus['paid'] as $value) {
            $ca += $value->total;
        }
        $revenusEspere = $ca;
        foreach ($commandesParStatus['cancelled'] as $value) {
            $revenusEspere += $value->total;
        }

        $stats['boutiques'] = [$boutiques, 'bg-blue-500/10', 'fi fi-rr-store-alt', 'text-blue-500'];
        $stats['commandes'] = [$commandes, 'bg-green-500/10', 'fi fi-rr-order-history', 'text-green-500'];
        $stats['produits'] = [$produits, 'bg-red-500/10', 'fi fi-rr-box-open-full', 'text-red-500'];
        $stats['clients'] = [$clients, 'bg-amber-500/10', 'fi fi-rr-membership', 'text-amber-500'];
        $stats['categories'] = [$categories, 'bg-purple-500/10', 'fi fi-rr-category-alt', 'text-purple-500'];
        $stats['paniers'] = [$paniers, 'bg-orange-500/10', 'fi fi-rr-cart-arrow-down', 'text-orange-500'];

        return view('back.admin.stats', compact(['stats', 'commandesParStatus', 'ca', 'revenusEspere']));
    }
}
