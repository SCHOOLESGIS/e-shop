<?php
namespace App\Http\Controllers;

use App\Models\Boutique;
use App\Http\Requests\StoreBoutiqueRequest;
use App\Http\Requests\UpdateBoutiqueRequest;
use App\Models\Panier;
use Illuminate\Support\Facades\Auth;

class BoutiqueController extends Controller
{
    public function index()
    {
        $boutiques = Boutique::with('produits')->paginate(10);
        $qte = $this->quantity();
        return view('front.boutiques.index', compact(['boutiques', 'qte']));
    }

    public function show(Boutique $boutique)
    {
        $qte = $this->quantity();
        $boutique->load(['produits']);
        // dd($boutique);
        return view('front.boutiques.show', compact(['boutique', 'qte']));
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
}
