@extends('layouts.dashboard')

@section('content')
<div class="mb-4 flex justify-between">
    <h2 class="text-2xl font-bold text-slate-400">Favoris</h2>
    <small class="text-2xl text-slate-400">Listes des produits</small>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($produits as $item)
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="relative h-64 w-full bg-gray-100">
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="Produit image" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-300 relative">
                        <img src="{{ asset('images/boutiques.jpg') }}" alt="Default image" class="w-full h-full object-cover opacity-60">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                    </div>
                @endif
            </div>

            <div class="p-4 flex flex-col justify-between h-full">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 hover:text-amber-400">
                        <a href="{{ route('produit.show', ['produit' => $item->name]) }}">{{ $item->name }}</a>
                    </h3>
                    <div class="text-Xl text-slate-600 font-bold mt-2">{{ $item->price }} FCFA</div>
                </div>

                <div class="mt-4 flex justify-between gap-2">
                    @auth
                        <form action="{{ route('buyer.panierItem.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="decrease" value="0">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="produit_id" value="{{ $item->id }}">
                            <button type="submit" class="flex items-center justify-center px-4 py-2 bg-yellow-400 text-black rounded-full hover:bg-yellow-500 transition">
                                <i class="fi fi-rr-shopping-cart-add mr-1"></i> Ajouter
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-2 bg-yellow-400 text-black rounded-full hover:bg-yellow-500 transition">
                            <i class="fi fi-rr-shopping-cart-add mr-1"></i> Se connecter
                        </a>
                    @endauth

                    @auth
                        <form action="{{ route('buyer.favoris.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="produit_id" value="{{ $item->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <button type="submit" class="flex items-center justify-center px-4 py-2 bg-red-400 text-white rounded-full hover:bg-red-500 transition">
                                <i class="fi fi-rr-heart"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-2 bg-red-400 text-white rounded-full hover:bg-red-500 transition">
                            <i class="fi fi-rr-heart"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach

    </div>

    {{-- Pagination si nécessaire --}}
    {{-- <div class="mt-6">
        {{ $produits->links('vendor.pagination.tailwind') }}
    </div> --}}
</div>
@endsection
