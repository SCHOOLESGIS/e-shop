<?php
namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;

use App\Models\Boutique;
use App\Http\Requests\StoreBoutiqueRequest;
use App\Http\Requests\UpdateBoutiqueRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BoutiqueController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $boutiques = Boutique::paginate(10);
        return view('back.admin.boutiques.index', compact('boutiques'));
    }

    public function create()
    {
        return view('back.admin.boutiques.create');
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

        return redirect()->route('admin.boutique.index')->with('success', 'Boutique créée avec succès.');
    }

    public function show(Boutique $boutique)
    {
        return view('back.admin.boutiques.show', compact('boutique'));
    }

    public function edit(Boutique $boutique)
    {
        return view('back.admin.boutiques.edit', compact('boutique'));
    }

    public function update(UpdateBoutiqueRequest $request, Boutique $boutique)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        } else {
            $logoPath = null;
        }

        $boutique->name = $data['name'];
        $boutique->slug = Str::slug($data['name']);
        $boutique->logo = $logoPath;
        $boutique->description = $data['description'];
        $boutique->update();

        return redirect()->route('admin.boutique.index')->with('success', 'Boutique mise à jour.');
    }

    public function destroy(Boutique $boutique)
    {
        $boutique->delete();
        return redirect()->route('admin.boutique.index')->with('success', 'Boutique supprimée.');
    }
}
