@extends('layouts.dashboard')

@section('content')
    <div class="w-full">
        <div class="flex justify-end">

            <a href="{{ route('admin.produit.create') }}" class="p-2 rounded text-white shadow-md flex gap-2 mb-2 bg-emerald-700 text-white">
                <i class="fi fi-rr-multiple"></i>
                ajouter produit
            </a>
        </div>
        <div class="w-full min-h-[300px] flex gap-3" style="flex-wrap: wrap">
            @foreach ($produits as $item)
                <div class="relative min-h-[400px] w-[300px] border rounded shadow-md" style="flex-grow: 1">
                    <div class="overflow-hidden h-[250px] bg-slate-200 relative flex items-center justify-center text-3xl text-slate-300">
                        @if($item->image != null)
                            <img class="w-full" src="{{ asset('storage/'.$item->image) }}" alt="">
                        @else
                            <div>500 X 500</div>
                        @endif
                        <div class="text-black text-sm font-bold rounded-md shadow-md bg-orange-300 absolute p-2 right-1 top-1">
                            {{ $item->stock }}
                        </div>
                    </div>
                    <div class="product-description p-2 relative">
                        <div class="flex justify-between mb-1">
                            <a href="{{ route('admin.produit.show', ['produit' => $item->id]) }}" class="text-lg">{{ $item->name }}</a>
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
        <div class="mt-5">
            {{ $produits->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
