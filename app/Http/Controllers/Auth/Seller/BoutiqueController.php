<?php
namespace App\Http\Controllers\Auth\seller;

use App\Http\Controllers\Controller;
use App\Models\Boutique;
use App\Http\Requests\StoreBoutiqueRequest;
use App\Http\Requests\UpdateBoutiqueRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BoutiqueController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $boutiques = Boutique::where('user_id', $id)->paginate(10);
        return view('back.seller.boutiques.index', compact('boutiques'));
    }

    public function create()
    {
        return view('back.seller.boutiques.create');
    }

    public function store(StoreBoutiqueRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        } else {
            $logoPath = null;
        }

        $boutique = new Boutique();
        $boutique->name = $data['name'];
        $boutique->slug = Str::slug($data['name']);
        $boutique->logo = $logoPath;
        $boutique->description = $data['description'];
        $boutique->user_id = Auth::id();
        $boutique->save();

        return redirect()
                ->route('seller.boutique.index')
                ->with('success', 'Boutique créée avec succès.');
    }

    public function show(Boutique $boutique)
    {
        $boutique->load('produits');

        return view('back.seller.boutiques.show', compact('boutique'));
    }

    public function edit(Boutique $boutique)
    {

        return view('back.seller.boutiques.edit', compact('boutique'));
    }

    public function update(UpdateBoutiqueRequest $request, Boutique $boutique)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            
            if ($boutique->logo && Storage::disk('public')->exists($boutique->logo)) {
                Storage::disk('public')->delete($boutique->logo);
            }

            $imagePath = $request->file('image')->store('produits', 'public');
        } else {
            $imagePath = $boutique->logo;
        }

        $boutique->name = $data['name'];
        $boutique->slug = Str::slug($data['name']);
        $boutique->logo = $imagePath;
        $boutique->description = $data['description'];
        $boutique->update();

        return redirect()->route('seller.boutique.index')->with('success', 'Boutique mise à jour.');
    }

    public function destroy(Boutique $boutique)
    {
        $boutique->delete();
        return redirect()
                ->route('seller.boutique.index')
                ->with('success', 'Boutique supprimée.');
    }
}
