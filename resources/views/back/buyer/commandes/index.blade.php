@props([
    'columns' => ['id', 'Nom client', 'Nom boutique', 'total', 'statut', 'actions'],
    'data' => [],
])

@extends('layouts.dashboard')

@section('content')
{{-- {{ dd($commandes) }} --}}
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
                        <td class="px-6 py-4">{{ $item->user->name }}</td>
                        <td class="px-6 py-4">{{ $item->boutique->name }}</td>
                        <td class="px-6 py-4">{{ $item->total }}</td>
                        <td class="px-6 py-4">
                            @if ($item->status == 'pending')
                                <div class="w-[100px] flex items-center justify-center px-3 py-2 bg-amber-500/30 text-amber-500 rounded-full gap-3"><div class="bg-amber-500 rounded-full" style="width: 5px; height: 5px;"></div><div>{{ ucfirst(strtolower($item->status)) }}</div></div>
                            @elseif ($item->status == 'paid')
                                <div class="w-[100px] flex items-center justify-center px-3 py-2 bg-green-500/30 text-green-500 rounded-full gap-3"><div class="bg-green-500 rounded-full" style="width: 5px; height: 5px;"></div><div>{{ ucfirst(strtolower($item->status)) }}</div></div>
                            @elseif ($item->status == 'shipped')
                                <div class="w-[100px] flex items-center justify-center px-3 py-2 bg-blue-500/30 text-blue-500 rounded-full gap-3"><div class="bg-blue-500 rounded-full" style="width: 5px; height: 5px;"></div><div>{{ ucfirst(strtolower($item->status)) }}</div></div>
                            @else
                                <div class="w-[100px] flex items-center justify-center px-3 py-2 bg-red-500/30 text-red-500 rounded-full gap-3"><div class="bg-red-500 rounded-full" style="width: 5px; height: 5px;"></div><div>{{ ucfirst(strtolower($item->status)) }}</div></div>
                            @endif
                        </td>
                        {{-- <td class="px-6 py-4">{{ $item }}</td> --}}
                        <td class="px-6 py-4 flex gap-3">
                            <a href="{{ route('buyer.commande.show', ['commande' => $item->id]) }}">
                                <i class="fi fi-rr-eye"></i>
                            </a>
                            <form action="{{ route('buyer.commande.destroy', ['commande' => $item->id]) }}" method="POST">
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
