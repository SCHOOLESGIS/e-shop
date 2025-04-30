<?php
namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;

use App\Models\Boutique;
use App\Http\Requests\StoreBoutiqueRequest;
use App\Http\Requests\UpdateBoutiqueRequest;
use Illuminate\Support\Facades\Auth;

class BoutiqueController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $boutiques = Boutique::where('user_id', $id)->paginate(10);
        return view('back.admin.boutique.index', compact('boutiques'));
    }

    public function create()
    {
        return view('back.admin.boutique.create');
    }

    public function store(StoreBoutiqueRequest $request)
    {
        $data = $request->validated();
        $boutique = new Boutique();
        $boutique->name = $data['name'];
        $boutique->slug = $data['slug'];
        $boutique->logo = $data['logo'];
        $boutique->description = $data['description'];
        $boutique->user_id = Auth::id();
        $boutique->save();

        return redirect()->route('back.admin.boutique.index')->with('success', 'Boutique créée avec succès.');
    }

    public function show(Boutique $boutique)
    {
        return view('back.admin.boutique.show', compact('boutique'));
    }

    public function edit(Boutique $boutique)
    {
        return view('back.admin.boutique.edit', compact('boutique'));
    }

    public function update(UpdateBoutiqueRequest $request, Boutique $boutique)
    {
        $data = $request->validated();
        $boutique->name = $data['name'];
        $boutique->slug = $data['slug'];
        $boutique->logo = $data['logo'];
        $boutique->description = $data['description'];
        $boutique->update();

        return redirect()->route('back.admin.boutique.index')->with('success', 'Boutique mise à jour.');
    }

    public function destroy(Boutique $boutique)
    {
        $boutique->delete();
        return redirect()->route('back.admin.boutique.index')->with('success', 'Boutique supprimée.');
    }
}
