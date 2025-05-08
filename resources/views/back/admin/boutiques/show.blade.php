@extends('layouts.dashboard')

@section('content')
    <div class="w-full">
        <div class="flex justify-between">
            <a href="{{ route('admin.boutique.index') }}" class="w-[100px] p-2 rounded text-green shadow-md flex gap-2 mb-2 border-2 border-emerald-700 text-emerald-700">
                <i class="fi fi-rr-undo"></i>
                retour
            </a>

            <a href="{{ route('admin.produit.create') }}" class="p-2 rounded text-white shadow-md flex gap-2 mb-2 bg-emerald-700 text-white">
                <i class="fi fi-rr-multiple"></i>
                ajouter produit
            </a>
        </div>
        <div class="w-full min-h-[300px] mb-3 rounded shadow-md border flex items-center justify-center flex-col font-bold text-white"  style="background: linear-gradient(0deg, rgba(0,0,0,0.5), rgba(0,0,0,0.5)),url(/images/boutique.png) no-repeat; background-position: center; background-size: cover;">
            <h1 class="text-5xl mb-3">{{ $boutique->name }}</h1>
            <p class="text-sm text-center">{{ $boutique->description }}</p>
        </div>
        <div class="mb-2 text-xl text-slate-500">Voici la liste des produits</div>

        <div class="w-full min-h-[300px] flex gap-3" style="flex-wrap: wrap">
            @foreach ($boutique->produits as $item)
                <div class="min-h-[400px] w-[300px] border rounded shadow-md relative" style="flex-grow: 1">
                    <div class="overflow-hidden h-[250px] bg-slate-200 relative flex items-center justify-center text-3xl text-slate-300">
                        300 X 250
                        <div class="text-black text-sm font-bold rounded-md shadow-md bg-orange-300 absolute p-2 right-1 top-1">
                            {{ $item->stock }}
                        </div>
                    </div>
                    <div class="product-description p-2">
                        <div class="flex justify-between mb-1">
                            <a href="{{ route('admin.produit.show', ['produit' => $item->id]) }}" class="hover:text-amber-500 hover:text-underlined text-lg">{{ $item->name }}</a>
                            <div class="text-emerald-600">{{ $item->price }} f cfa</div>
                        </div>
                        <p class="text-elipsis text-slate-500">
                            {{ $item->description }}
                        </p>
                    </div>
                    <a href="{{ route('admin.produit.edit', ['produit' => $item->id]) }}" class="absolute right-1 bottom-1 text-slate-400 hover:underline hover:text-slate-500">
                        Modifier
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
