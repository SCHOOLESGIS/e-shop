@extends('layouts.dashboard')

@section('content')
    <div class="mb-4 flex justify-between">
        <h2 class="text-2xl font-bold text-slate-400">Produits</h2>
        <small class="text-2xl text-slate-400">Créer un produit</small>
    </div>
    <div class="w-full h-full flex items-center justify-center">
        <form method="POST" action="{{ route('admin.produit.store') }}" class="w-[400px] min-h-[300px]">
            @csrf
            @method('POST')
            <!-- Email Address -->
            <div>
                <x-input-label for="name" :value="__('Nom de la boutique')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="image" :value="__('Image (optionnel)')" />
                <input type="file" name="image" id="image" class="block mt-1 w-full border border-slate-300 shadow-md rounded">
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="price" :value="__('Prix du produit')" />
                <input type="number" min="0" name="price" id="price" class="block mt-1 w-full border border-slate-300 shadow-md rounded">
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="stock" :value="__('Stock du produit')" />
                <input type="number" min="0" name="stock" id="stock" class="block mt-1 w-full border border-slate-300 shadow-md rounded">
                <x-input-error :messages="$errors->get('stock')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />

                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description de la boutique ..." class="border border-slate-300 shadow-md w-full rounded"></textarea>

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('admin.produit.index') }}" class="">
                    <div class = "inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-[#314d43] hover:text-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Retour
                    </div>
                </a>

                <x-primary-button class="ms-3">
                    {{ __('Créer une boutique') }}
                </x-primary-button>
            </div>
        </form>

    </div>
@endsection
