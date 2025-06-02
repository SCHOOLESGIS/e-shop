<?php
namespace App\Http\Controllers;

use App\Enum\PaginationEnum;
use App\Models\Boutique;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoutiqueController extends Controller
{
    public function index(Request $request)
    {

        $qte = $this->quantity();
        $search = $request->input('search');

        $query = Boutique::with('produits');

        if ($search) {
            $boutiques = $query->where('name', 'like', '%' . $search . '%')->paginate();
            return view('front.boutiques.index', compact('boutiques', 'qte'));
        }

        $boutiques = $query->paginate(PaginationEnum::NUMBER);

        return view('front.boutiques.index', compact('boutiques', 'qte'));
    }

    public function show(Boutique $boutique)
    {
        $qte = $this->quantity();
        $boutique->load(['produits']);
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
