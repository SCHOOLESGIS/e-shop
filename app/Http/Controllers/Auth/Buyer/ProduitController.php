<?php
namespace App\Http\Controllers\Auth\Buyer;

use App\Http\Controllers\Controller;

use App\Models\Produit;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::paginate(10);
        return view('back.buyer.produits.index', compact('produits'));
    }

    public function show(Produit $produit)
    {
        return view('back.buyer.produits.show', compact('produit'));
    }
}
