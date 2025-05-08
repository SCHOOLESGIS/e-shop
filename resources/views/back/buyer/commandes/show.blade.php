@extends('layouts.dashboard')

@section('content')
<main class="max-w-full mx-auto my-8 bg-white p-4 rounded shadow-md">
    <div class="w-full flex justify-between">
        <h1 class="text-2xl font-semibold mb-4">Détails de votre commande <span class="text-gray-500 text-sm">({{ count($commande->commandeItems) }} articles)</span></h1>

        @if ($commande->status == 'pending')
            <div class="text-xs w-[100px] flex items-center justify-center px-3 py-2 bg-amber-500/30 text-amber-500 rounded-full gap-3"><div class="bg-amber-500 rounded-full" style="width: 5px; height: 5px;"></div><div>{{ ucfirst(strtolower($commande->status)) }}</div></div>
        @elseif ($commande->status == 'paid')
            <div class="text-xs w-[100px] flex items-center justify-center px-3 py-2 bg-green-500/30 text-green-500 rounded-full gap-3"><div class="bg-green-500 rounded-full" style="width: 5px; height: 5px;"></div><div>{{ ucfirst(strtolower($commande->status)) }}</div></div>
        @elseif ($commande->status == 'shipped')
            <div class="text-xs w-[100px] flex items-center justify-center px-3 py-2 bg-blue-500/30 text-blue-500 rounded-full gap-3"><div class="bg-blue-500 rounded-full" style="width: 5px; height: 5px;"></div><div>{{ ucfirst(strtolower($commande->status)) }}</div></div>
        @else
            <div class="text-xs w-[100px] flex items-center justify-center px-3 py-2 bg-red-500/30 text-red-500 rounded-full gap-3"><div class="bg-red-500 rounded-full" style="width: 5px; height: 5px;"></div><div>{{ ucfirst(strtolower($commande->status)) }}</div></div>
        @endif
    </div>

    @forelse ($commande->commandeItems as $item)
    <div class="divide-y divide-gray-200">
        <!-- Item 1 -->
        <div class="flex items-center justify-between py-3 px-8 gap-8">
          <div class="flex items-center gap-4 w-[calc(100%/3)]">
            {{-- <img src="product1.jpg" alt="Product 1" class="w-20 h-20 object-cover rounded"> --}}
            <div>
              <h2 class="font-medium text-lg">{{ $item->produit->name }}</h2>
              <p class="text-sm text-gray-500">{{ $item->produit->description }}</p>
            </div>
          </div>

          <div class="flex items-center gap-4 w-[calc(100%/3)]">
            {{-- <img src="product1.jpg" alt="Product 1" class="w-20 h-20 object-cover rounded"> --}}
            <div>
              <h2 class="font-medium text-lg">{{ $item->produit->boutique->name }}</h2>
              <p class="text-sm text-gray-500 w-[300px]">{{ $item->produit->boutique->description }}</p>
            </div>
          </div>

          <div class="flex items-center justify-end w-[calc(100%/3)] gap-6">
            <div>
              <label class="text-sm text-gray-500 block">Quantité</label>
              <input type="number" value="{{ $item->quantity }}" class="w-16 border border-gray-300 rounded px-2 py-1 text-center" readonly>
            </div>

            <div class="text-right">
                <label class="text-sm text-gray-500 block">Prix</label>
                <input type="number" value="{{ $item->produit->price }}" class="w-32 border border-gray-300 rounded px-1 py-1 text-center" readonly>
            </div>

          </div>
      </div>
    @empty
      Aucune commande passé
    @endforelse
    <!-- Footer Actions -->
    <div class="flex justify-between items-center mt-10 px-8">
        <div class="">
            <a href="{{ route('buyer.commande.index') }}" class="text-underline hover:text-amber-500">Historique des commandes</a>
        </div>
      <div class="text-right">
        <p class="text-lg font-semibold mb-2">Total: € {{ $commande->total }}</p>
      </div>
    </div>

    <div class="">
        @if ($commande->status == 'pending')
            <form action="{{ route('buyer.commande.update', ['commande' => $commande->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="paid">
                <button type="submit" class="w-full py-4 mt-6 rounded bg-black hover:bg-amber-500 text-white hover:text-black text-lg flex gap-3 items-center justify-center" style="transition: all .2s .1s ease-in-out;"><span class="mt-2"><i class="fi fi-rr-usd-circle"></i></span> <span>Payer la commande</span></button>
            </form>
        @elseif ($commande->status == 'paid')
            <form action="{{ route('buyer.commande.update', ['commande' => $commande->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="cancelled">
                <button type="submit" class="w-full py-4 mt-6 rounded bg-black hover:bg-red-500 text-white hover:text-white text-lg flex gap-3 items-center justify-center" style="transition: all .2s .1s ease-in-out;"><span class="mt-2"><i class="fi fi-rr-usd-circle"></i></span> <span>Annuler la commande</span></button>
            </form>
        @else
            <div class="w-full py-4 mt-6 rounded bg-slate-300 text-slate-500 text-lg flex gap-3 items-center justify-center cursor-not-allowed" style="transition: all .2s .1s ease-in-out;">
                Vous ne pouvez plus annulé la commande
            </div>
        @endif
    </div>

  </main>
@endsection
