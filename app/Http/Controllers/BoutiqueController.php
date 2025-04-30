<?php
namespace App\Http\Controllers;

use App\Models\Boutique;
use App\Http\Requests\StoreBoutiqueRequest;
use App\Http\Requests\UpdateBoutiqueRequest;

class BoutiqueController extends Controller
{
    public function index()
    {
        $boutiques = Boutique::paginate(10);
        return view('back.boutique.index', compact('boutiques'));
    }

    public function show(Boutique $boutique)
    {
        return view('back.boutique.show', compact('boutique'));
    }
}
