<?php

namespace App\Http\Controllers;

use App\Models\Boutique;
use App\Models\Panier;
use App\Models\PanierItem;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qte = $this->quantity();
        return view('front.home.index', compact('qte'));
    }

    public function about()
    {
        $qte = $this->quantity();
        return view('front.home.about', compact('qte'));
    }

    public function blog()
    {
        $qte = $this->quantity();
        return view('front.home.blog', compact('qte'));
    }

    public function contact()
    {
        $qte = $this->quantity();
        return view('front.home.contact', compact('qte'));
    }

    public function panier()
    {
        $panierItemsParBoutique = PanierItem::with('produit.boutique')
        ->whereHas('panier', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->get()
        ->unique(fn($item) => $item->id)
        ->groupBy(fn($item) => $item->produit->boutique->id);


        if ($panierItemsParBoutique) {
            foreach ($panierItemsParBoutique as $items) {
                $money = 0;
                foreach ($items as $item) {
                    $money += $item->produit->price * $item->quantity;
                }
                $items->money = $money;
            }
        }

        $qte = $this->quantity();

        return view('front.home.panier', compact(['panierItemsParBoutique', 'qte']));
    }

    public function quantity ()
    {
        $panierQuantity = 0;
        if (Auth::user()) {
            $id = Auth::user()->id;
            $panier = Panier::with('items')->where('user_id', $id)->first();
            if (!$panier == null) {
                foreach ($panier->items as $item) {
                    $panierQuantity += $item->quantity;
                }
            }
        }
        return $panierQuantity;
    }
    public function modalite (Boutique $boutique)
    {
        $items = PanierItem::with('produit')
            ->whereHas('panier', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->whereHas('produit', function ($query) use ($boutique) {
                $query->where('boutique_id', $boutique->id);
            })
            ->get();

        $money = $items->sum(fn($item) => $item->produit->price * $item->quantity);

        $qte = $items->sum('quantity');

        return view('front.home.modalite', [
            'items' => $items,
            'money' => $money,
            'qte' => $qte,
            'boutique' => $boutique,
        ]);
    }
}
