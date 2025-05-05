<?php
namespace App\Http\Controllers\Auth\Buyer;

use App\Enum\PaginationEnum;
use App\Http\Controllers\Controller;

use App\Models\Produit;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::paginate(PaginationEnum::NUMBER);
        return view('back.buyer.produits.index', compact('produits'));
    }

    public function show(Produit $produit)
    {
        return view('back.buyer.produits.show', compact('produit'));
    }
}
