@extends('layouts.dashboard')

@section('content')
    <div class="w-full">
        <div class="flex justify-between">
            <a href="{{ route('admin.boutique.index') }}" class="w-[100px] p-2 rounded text-white shadow-md flex gap-2 mb-2 border-2 border-emerald-700 text-emerald-700">
                <i class="fi fi-rr-undo"></i>
                retour
            </a>
        </div>
        <div class="w-full min-h-[300px] mb-3 rounded shadow-md border flex items-center justify-center flex-col">
            <h1 class="text-5xl mb-3">{{ $boutique->name }}</h1>
            <p class="text-sm text-center">{{ $boutique->description }}</p>
        </div>
        <div class="mb-2 text-xl text-slate-500">Voici la liste des produits</div>

        <div class="w-full min-h-[300px] flex gap-3" style="flex-wrap: wrap">
            @foreach ($boutique->produits as $item)
                <div class="min-h-[400px] w-[300px] border rounded shadow-md" style="flex-grow: 1">
                    <div class="overflow-hidden h-[250px] bg-slate-200 relative flex items-center justify-center text-3xl text-slate-300">
                        300 X 250
                        <div class="text-black text-sm font-bold rounded-md shadow-md bg-orange-300 absolute p-2 right-1 top-1">
                            {{ $item->stock }}
                        </div>
                    </div>
                    <div class="product-description p-2">
                        <div class="flex justify-between mb-1">
                            <h2 class="text-lg">{{ $item->name }}</h2>
                            <div class="text-emerald-600">{{ $item->price }} f cfa</div>
                        </div>
                        <p class="text-elipsis text-slate-500">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
