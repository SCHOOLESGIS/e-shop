<?php
namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boutique;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Panier;
use App\Models\Produit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        ->get();

        $clients = User::withCount('commandes')
        ->where('role', 'buyer')
        ->orderBy('commandes_count', 'desc')
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

        $last7Days = Carbon::now()->subDays(6)->startOfDay();
        $role = 'buyer';

        $commandesParJour = Commande::where('created_at', '>=', $last7Days)
        ->select(DB::raw('DATE(created_at) as jour'), DB::raw('COUNT(*) as total'))
        ->groupBy('jour')
        ->orderBy('jour')
        ->get()
        ->keyBy('jour');

        $jours = [];
        $totaux = [];
        Carbon::setLocale('fr');
        for ($i = 6; $i >= 0; $i--) {
            $jour = Carbon::now()->subDays($i)->format('Y-m-d');
            $jourText = Carbon::now()->subDays($i)->isoFormat('ddd');
            $jours[] = $jourText;
            $totaux[] = $commandesParJour[$jour]->total ?? 0;
        }

        $boutiquesR = Boutique::with(['produits.commandeItems.commande.user'])
            ->get();
        $bestSeller = $boutiquesR->flatMap(function ($boutique) use ($role) {
            return $boutique->produits()
                ->withCount('commandeItems')
                ->get();
        })
        ->sortByDesc('commande_items_count')
        ->values()
        ->take(5);
            // dd($bestSeller);


        $stats['boutiques'] = [$boutiques, 'bg-blue-500/10', 'fi fi-rr-store-alt', 'text-blue-500'];
        $stats['commandes'] = [$commandes, 'bg-green-500/10', 'fi fi-rr-order-history', 'text-green-500'];
        $stats['produits'] = [$produits, 'bg-red-500/10', 'fi fi-rr-box-open-full', 'text-red-500'];
        $stats['clients'] = [$clients, 'bg-amber-500/10', 'fi fi-rr-membership', 'text-amber-500'];
        $stats['categories'] = [$categories, 'bg-teal-500/10', 'fi fi-rr-category-alt', 'text-teal-500'];
        $stats['paniers'] = [$paniers, 'bg-cyan-500/10', 'fi fi-rr-cart-arrow-down', 'text-cyan-500'];

        return view('back.admin.stats', compact(['stats', 'commandesParStatus', 'bestSeller', 'ca', 'revenusEspere', 'jours', 'totaux']));
    }
}
