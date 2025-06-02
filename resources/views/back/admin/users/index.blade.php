@props([
    'columns' => ['id', 'Nom d\'utilisateur', 'email', 'role', 'crée le', 'actions'],
    'data' => [],
])

@extends('layouts.dashboard')

@section('content')
    <div class="mb-4 flex justify-between">
        <h2 class="text-2xl font-bold text-slate-400">Utilisateurs</h2>
        <small class="text-2xl text-slate-400">Listes des utilisateurs</small>
    </div>
    <div class="w-full flex justify-between mb-4">
        <form action="" class="flex border rounded">
            <input type="text" class="border-0" placeholder="Rechercher">
            <button type="submit" class="px-3 bg-emerald-700 text-white rounded">
                <i class="fi fi-rr-category"></i>
            </button>
        </form>
        <div class="">
            <a href="{{ route('admin.user.create') }}" class="flex items-center gap-2 px-2 py-2 text-white bg-orange-500 rounded hover:bg-orange-600">
                <i class="fi fi-rr-add"></i>
                Créer un utilisateur
            </a>
        </div>
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
                @foreach ($users as $item)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->name }}</td>
                        <td class="px-6 py-4">{{ $item->email }}</td>
                        <td class="px-6 py-4">
                            @if ($item->role == "admin")
                                <span class="px-3 py-1 bg-red-500/10 text-red-500 rounded">{{ $item->role }}</span>
                            @elseif($item->role == "seller")
                                <span class="px-3 py-1 bg-green-500/10 text-green-500 rounded">{{ $item->role }}</span>
                            @else
                                <span class="px-3 py-1 bg-blue-500/10 text-blue-500 rounded">{{ $item->role }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $item->created_at }}</td>
                        <td class="px-6 py-4 flex gap-3">
                            @if ($item->role != "admin")
                                <a href="{{ route('admin.user.edit', ['user' => $item->id]) }}">
                                    <i class="fi fi-rr-file-edit"></i>
                                </a>
                                <form action="{{ route('admin.user.destroy', ['user' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fi fi-rr-delete"></i>
                                    </button>
                                </form>

                            @else
                                <span class="text-red-500">Aucune</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4 text-black">
        {{ $users->links('vendor.pagination.tailwind') }}
    </div>
@endsection
