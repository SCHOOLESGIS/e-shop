<?php
namespace App\Http\Controllers\Auth\Buyer;

use App\Http\Controllers\Controller;

use App\Models\Boutique;
use Illuminate\Support\Facades\Auth;

class BoutiqueController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $boutiques = Boutique::paginate(10);
        return view('back.buyer.boutique.index', compact('boutiques'));
    }

    public function show(Boutique $boutique)
    {
        return view('back.buyer.boutique.show', compact('boutique'));
    }
}
