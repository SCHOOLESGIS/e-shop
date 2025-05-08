@extends('layouts.dashboard')

@section('content')
    <div class="w-full h-full items-center justify-center flex flex-wrap flex-col p-2 rounded border shadow gap-2">
        <div class="lg:visible grow w-full h-[200px] rounded border flex items-center justify-center" style="background: linear-gradient(0deg, rgba(0,0,0,0.4), rgba(0,0,0,0.4)),url(/images/img-grid-1.jpg) no-repeat; background-position: center; background-size: cover;">
            <div class="w-full mb-4 flex justify-center">
                <small class="text-5xl capitalize font-bold text-white">Créer une boutique</small>
            </div>
        </div>
        <div class="w-full grow items-center justify-center flex flex-wrap flex-col">
            <form method="POST" action="{{ route('seller.boutique.store') }}" enctype="multipart/form-data" class="w-full min-h-[300px]">
                @csrf
                @method('POST')
                <!-- Email Address -->
                <div class="flex w-full flex-wrap gap-3">
                    <div class="w-[300px] grow p-3 border rounded">
                        <div>
                            <x-input-label for="name" :value="__('Nom de la boutique')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="logo" :value="__('Logo (optionnel)')" />
                            <input type="file" name="logo" id="logo" class="px-1 py-2 block mt-1 w-full border border-slate-300 rounded">
                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="w-[300px] grow p-3 border rounded">
                        <div class="flex flex-col gap-2">
                            <x-input-label for="description" :value="__('Description')" />

                            <textarea name="description" id="description" cols="30" rows="10" placeholder="Description de la boutique ..." class="border border-slate-300 w-full rounded"></textarea>

                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                </div>
                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('seller.boutique.index') }}" class="">
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
    </div>
@endsection
