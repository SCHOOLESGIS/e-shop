@props([
    'columns' => ['id', 'Utilisateurs', 'nombre d\'items', 'crée le'],
])

@extends('layouts.dashboard')

@section('content')
    <div class="mb-4 flex justify-between">
        <h2 class="text-2xl font-bold text-slate-400">Paniers</h2>
        <small class="text-2xl text-slate-400">Listes des paniers</small>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <table class="w-full text-sm text-left text-gray-600" id="datatable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    @foreach ($columns as $column)
                        <th scope="col" class="px-6 py-3">{{ $column }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($paniers as $item)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->user->name }}</td>
                        <td class="px-6 py-4">{{ count($item->items) }}</td>
                        <td class="px-6 py-4">{{ $item->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4 text-black">
        {{ $paniers->links('vendor.pagination.tailwind') }}
    </div>
@endsection




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
                @foreach ($paniers as $panier)
                    {{ $panier }}
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
