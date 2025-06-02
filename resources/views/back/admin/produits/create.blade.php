@extends('layouts.dashboard')

@section('content')
    <div class="w-full h-full items-center justify-center flex flex-wrap flex-col p-2 rounded border shadow gap-2">
        <div class="lg:visible grow w-full h-[200px] rounded border flex items-center justify-center" style="background: linear-gradient(0deg, rgba(0,0,0,0.4), rgba(0,0,0,0.4)),url(/images/produit.jpg) no-repeat; background-position: center; background-size: cover;">
            <div class="w-full mb-4 flex justify-center">
                <small class="text-5xl capitalize font-bold text-white">Créer un produit</small>
            </div>
        </div>
        <div class="w-full grow items-center justify-center flex flex-wrap flex-col">
            <form method="POST" action="{{ route('admin.produit.store') }}" enctype="multipart/form-data" class="w-full min-h-[300px]">
                @csrf
                @method('POST')
                <!-- Email Address -->
                <div class="flex w-full flex-wrap gap-3">
                    <div class="w-[300px] grow p-3 border rounded">
                        <div>
                            <x-input-label for="name" :value="__('Nom du produit')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image (optionnel)')" />
                            <input type="file" name="image" id="image" class="block mt-1 w-full border border-slate-300 rounded px-1 py-2">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Prix du produit')" />
                            <input type="number" min="0" name="price" id="price" class="block mt-1 w-full border border-slate-300 rounded">
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="stock" :value="__('Stock du produit')" />
                            <input type="number" min="0" name="stock" id="stock" class="block mt-1 w-full border border-slate-300 rounded">
                            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="w-[300px] grow p-3 border rounded">
                        <div class="mt-4">
                            <select name="boutique_id" id="" class="border-1 border-slate-300 w-full rounded">
                                @foreach ($boutiques as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('boutique_id')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <select name="categorie_id" id="" class="border-1 border-slate-300 w-full rounded">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('categorie_id')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />

                            <textarea name="description" id="description" cols="30" rows="5" placeholder="Description du produit ..." class="border border-slate-300 w-full rounded"></textarea>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('admin.produit.index') }}" class="">
                        <div class = "inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-[#314d43] hover:text-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Retour
                        </div>
                    </a>

                    <x-primary-button class="ms-3">
                        {{ __('Créer un produit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection
