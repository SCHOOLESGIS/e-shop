@extends('layouts.dashboard')

@section('content')
    <div class="flex gap-3 w-full min-h-[400px] wrap">
        <div class="h-[600px] w-[300px] grow rounded shadow-md border bg-slate-200 flex items-center justify-center text-4xl text-slate-300 relative overflow-hidden">
            <a href="{{ route('seller.produit.index') }}" class="px-2 bg-red-500 rounded-full absolute text-white text-sm flex items-center justify-center shadow-md border-1 pointer border-white top-1 left-1">
                Accéder aux produits
            </a>
            {{-- {{ dd($produit->image) }} --}}
            @if($produit->image != null)
                <img class="w-full" src="{{ asset('storage/'.$produit->image) }}" alt="">
            @else
                <div>500 X 500</div>
            @endif
        </div>
        <div class="h-[400px] w-[300px] grow flex flex-col items-start">
            <h1 class="text-3xl mb-6">{{ $produit->name }}</h1>
            <div class="text-lg text-slate-700 mb-6">
                Catégorie : <span class=" px-2 py-1 rounded-full bg-green-100 text-green-500">{{ $produit->categorie->name }}</span>
            </div>
            <div class="text-lg text-slate-700 mb-0">Description : </div>
            <div class="text-lg text-slate-400 mb-6">
                {{ $produit->description }}
            </div>
            <div class="text-lg text-slate-700 mb-3">Boutique :             <span class="text-lg text-slate-400 mb-6">
                {{ $produit->boutique->name }}
            </span></div>

            <div class="text-lg text-slate-700 mb-6"><span class="text-lg text-slate-400 mb-6">
                "Chez <strong>{{ $produit->boutique->name }}</strong> {{ $produit->boutique->description }}"
            </span></div>
            <div class="text-lg text-slate-700 mb-6">Crée le :             <span class="text-lg text-slate-400 mb-6">
                {{ $produit->created_at }}
            </span></div>
        </div>
    </div>
@endsection
