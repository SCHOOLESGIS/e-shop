@extends('layouts.dashboard')

@section('content')
<div class="mb-8 rounded">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Image</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Produit</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Prix</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Quantité</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Total</th>
                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Supprimer</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Produit 1 -->
                @foreach ($panier->items as $item)
                    <tr>
                        <td class="px-4 py-4">
                            <img src="{{ $item->produit->image }}" alt="{{ $item->produit->image }}" class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="px-4 py-4">
                            <h2 class="text-gray-800 text-sm font-semibold">{{ $item->produit->name }}</h2>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700">${{ $item->produit->price }}</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-1">
                                <form action="{{ route('admin.panierItem.store') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="decrease" value="1">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="produit_id" value="{{ $item->produit->id }}">
                                    <button type="submit" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">-</button>
                                </form>
                                <input type="text" value="{{ $item->quantity }}" class="w-12 text-center border border-gray-300 rounded" />
                                <form action="{{ route('admin.panierItem.store') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="decrease" value="0">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="produit_id" value="{{ $item->produit->id }}">
                                    <button type="submit" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
                                </form>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-700">${{ $item->quantity*$item->produit->price }}</td>
                        <td class="px-4 py-4">
                            <form action="{{ route('admin.panierItem.destroy', ['panier_item' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" href="#" class="text-red-600 hover:text-red-800 font-bold text-lg">
                                    <i class="fi fi-rr-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
