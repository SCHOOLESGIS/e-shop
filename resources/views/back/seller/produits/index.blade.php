@extends('layouts.dashboard')

@section('content')
    <div class="w-full">
        <div class="flex justify-between mb-3 ">
            <form action="" class="flex border rounded">
                <input type="text" class="border-0" placeholder="Rechercher">
                <button type="submit" class="px-3 bg-emerald-700 text-white rounded">
                    <i class="fi fi-rr-category"></i>
                </button>
            </form>
            <a href="{{ route('seller.produit.create') }}" class="p-2 rounded text-white shadow-md flex gap-2 bg-emerald-700 text-white">
                <i class="fi fi-rr-multiple"></i>
                ajouter produit
            </a>
        </div>
        <div class="w-full min-h-[300px] flex gap-3" style="flex-wrap: wrap">
            @foreach ($produits as $item)
                <div class="relative min-h-[400px] w-[300px] border rounded shadow-md" style="flex-grow: 1">
                    <div class="overflow-hidden h-[250px] bg-slate-200 relative flex items-center justify-center text-3xl text-slate-300">
                        @if ($item->image != null)
                            <img src="{{ asset('storage/'.$item->image) }}" style="object-fit: cover; object-position: center; width: 100%" alt="Books" class="product-image">
                        @else
                            <img src="{{ asset("images/produitbl.jpg") }}" style="object-fit: cover; object-position: center; width: 100%" alt="Books" class="product-image">
                        @endif
                        <div class="text-black text-sm font-bold rounded-md shadow-md bg-orange-300 absolute p-2 right-1 top-1">
                            {{ $item->stock }} en stock
                        </div>
                    </div>
                    <div class="product-description p-2 relative">
                        <div class="flex justify-between mb-1">
                            <a href="{{ route('seller.produit.show', ['produit' => $item->id]) }}" class="text-lg">{{ $item->name }}</a>
                            <div class="text-emerald-600">{{ $item->price }} f cfa</div>
                        </div>
                        <p class="text-elipsis text-slate-500">
                            {{ $item->description }}
                        </p>
                    </div>
                    <a href="{{ route('seller.produit.edit', ['produit' => $item->id]) }}" class="absolute right-1 bottom-1 text-slate-400 hover:underline hover:text-slate-500">
                        Modifier
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-5">
        {{-- {{ dd($produits->links('vendor.pagination.tailwind')) }} --}}
        {{ $produits->links('vendor.pagination.tailwind') }}
    </div>
@endsection
