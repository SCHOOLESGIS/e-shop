<?php

namespace App\Http\Controllers\Auth\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Favoris;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavorisController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == "buyer") {
            $user = Auth::user();
            $favoris = $user->favoris;
            $favoris->load('produit');
            $produits = $favoris->pluck('produit')->filter();
            return view("back.buyer.favoris.index", compact('produits'));
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'user_id' => ['integer', 'required', 'exists:users,id'],
            'produit_id' => ['integer', 'required', 'exists:produits,id', 'unique:produits,id'],
        ]);

        $favoris = new Favoris();
        $favoris->user_id = $request->input('user_id');
        $favoris->produit_id = $request->input('produit_id');
        $favoris->save();

        return redirect()->back()->withErrors($validator)->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Favoris $favoris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favoris $favoris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favoris $favoris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favoris $favoris)
    {
        //
    }
}
