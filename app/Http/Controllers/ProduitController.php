<?php

namespace App\Http\Controllers;

use App\Enum\PaginationEnum;
use App\Models\Produit;
use App\Http\Requests\StoreProduitRequest;
use App\Http\Requests\UpdateProduitRequest;
use App\Models\Panier;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qte = $this->quantity();
        $produits = Produit::paginate(PaginationEnum::NUMBER);
        return view('front.produits.index', compact(['produits', 'qte']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        $qte = $this->quantity();
        return view('front.produits.show', compact(['produit', 'qte']));
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
