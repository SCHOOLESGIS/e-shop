<?php

namespace App\Http\Controllers\Auth\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Panier;
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
        $commandes = Commande::all()->where('user_id', Auth::id())->groupBy('status');
        $statuses = ['pending', 'paid', 'shipped', 'cancelled'];

        foreach ($statuses as $status) {
            if (!isset($commandes[$status])) {
                $commandes[$status] = collect();
            }
        }

        $ca = $commandes['paid']->sum('total');


        $revenusEspere = $ca + $commandes->get('cancelled', collect())->sum('total');
        $articles = Panier::with('items')->where('user_id', Auth::id())->first();
        $commandeFlat = $commandes->flatten();
        $commandeFlat->each->load('boutique');
        $boutiques = $commandeFlat->pluck('boutique')->unique('id');
        // dd($boutiques);
        $commandesRecents = Commande::with('commandeItems.produit')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get()->take(5);
        // $produits = $commandesRecents['commandeItems'];
        // dd($commandesRecents);

        $role = 'buyer';
        $last7Days = Carbon::now()->subDays(6)->startOfDay();

        $commandesParJour = Commande::where('user_id', Auth::id())->where('created_at', '>=', $last7Days)->whereHas('user', function ($query) use ($role) {
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

        return view('back.buyer.dashboard', compact(['commandes', 'ca', 'revenusEspere', 'articles', 'boutiques', 'commandesRecents', 'commandes', 'ca', 'revenusEspere', 'jours', 'totaux']));
    }
}
