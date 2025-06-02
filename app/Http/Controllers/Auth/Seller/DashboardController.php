<?php

namespace App\Http\Controllers\Auth\seller;

use App\Http\Controllers\Controller;
use App\Models\Boutique;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boutiques = Boutique::with(['produits.commandeItems.commande.user'])
            ->where('user_id', Auth::id())
            ->get();

        $role = 'buyer';
        $produits = $boutiques->flatMap(function ($boutique) use ($role) {
            return $boutique->produits()
                ->whereHas('commandeItems.commande', function ($query) use ($role) {
                    $query->whereHas('user', function ($query) use ($role) {
                        $query->where('role', $role);
                    });
                })
                ->withCount('commandeItems')
                ->get();
        })
        ->sortByDesc('commande_items_count')
        ->take(5);

        $commandeItems = $produits->flatMap(function ($produit) {
            return $produit->commandeItems;
        });

        $clients = $commandeItems->pluck('commande.user')->unique('id')->where('role', $role)->values()->take(5);
        foreach($clients as $client)
        {
            $client->load('commandes');
        }

        $commandes = $commandeItems->pluck('commande')->unique('id')->filter(function ($commande) {
            return optional($commande->user)->role === 'buyer';
        })->groupBy('status');

        $ca = $commandes->get('paid', collect())->sum('total');

        $revenusEspere = $ca + $commandes->get('cancelled', collect())->sum('total');

        $last7Days = Carbon::now()->subDays(6)->startOfDay();

        $commandesParJour = Commande::where('created_at', '>=', $last7Days)->whereHas('user', function ($query) use ($role) {
            return $query->where('role', $role);
        })->whereHas('boutique', function ($query) use ($boutiques) {
            return $query->whereIn('id', $boutiques->pluck('id'));
        })
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

        return view('back.seller.dashboard', compact(['boutiques', 'commandes', 'produits', 'clients', 'ca', 'revenusEspere', 'jours', 'totaux']));
    }
}
