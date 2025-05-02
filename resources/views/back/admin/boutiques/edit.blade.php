@extends('layouts.dashboard')

@section('content')
    <div class="mb-4 flex justify-between">
        <h2 class="text-2xl font-bold text-slate-400">Boutiques</h2>
        <small class="text-2xl text-slate-400">Mettre à jour une boutique</small>
    </div>
    <div class="w-full h-full flex items-center justify-center">
        <form method="POST" action="{{ route('admin.boutique.update', ['boutique' => $boutique->slug]) }}" enctype="multipart/form-data" class="w-[400px] min-h-[300px]">
            @csrf
            @method('PUT')
            <div>
                <x-input-label for="name" :value="__('Nom de la boutique')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$boutique->name" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="logo" :value="__('Logo (optionnel)')" />
                <input type="file" value="{{ $boutique->logo }}" name="logo" id="logo" class="block mt-1 w-full border border-slate-300 shadow-md rounded">
                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description de la boutique ..." class="border border-slate-300 shadow-md w-full rounded">{{ $boutique->description }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('admin.boutique.index') }}" class="">
                    <div class = "inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-[#314d43] hover:text-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Retour
                    </div>
                </a>
                <x-primary-button class="ms-3">
                    {{ __('Mettre à jour une boutique') }}
                </x-primary-button>
            </div>
        </form>

    </div>
@endsection
