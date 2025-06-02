@props([
    'columns' => ['id', 'Nom de la boutique', 'client', 'total payé', 'Statut', 'crée le', 'actions'],
    'data' => [],
])

@extends('layouts.dashboard')

@section('content')
    <div class="mb-4 flex justify-between">
        <h2 class="text-2xl font-bold text-slate-400">Commandes</h2>
        <small class="text-2xl text-slate-400">Listes des commandes</small>
    </div>
    <div class="w-full flex justify-between mb-4">
        <form action="" class="flex border rounded">
            <input type="text" class="border-0" placeholder="Rechercher">
            <button type="submit" class="px-3 bg-emerald-700 text-white rounded">
                <i class="fi fi-rr-category"></i>
            </button>
        </form>
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
                @foreach ($commandes as $item)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->boutique->name }}</td>
                        <td class="px-6 py-4">{{ $item->user->name }}</td>
                        <td class="px-6 py-4">{{ $item->total }}</td>
                        <td class="px-6 py-4">{{ $item->status }}</td>
                        <td class="px-6 py-4">{{ $item->created_at }}</td>
                        <td class="px-6 py-4 flex gap-3">
                            <a href="{{ route('admin.commande.show', ['commande' => $item->id]) }}">
                                <i class="fi fi-rr-eye"></i>
                            </a>
                            <form action="{{ route('admin.commande.destroy', ['commande' => $item->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="fi fi-rr-delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4 text-black">
        {{ $commandes->links('vendor.pagination.tailwind') }}
    </div>
@endsection
