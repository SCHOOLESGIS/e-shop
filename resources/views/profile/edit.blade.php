@extends('layouts.dashboard')

@section('content')
    <div class="sm:px-6 lg:px-8 flex justify-between">
        <h2 class="text-2xl font-bold text-slate-400">Paramètre du profil</h2>
    </div>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-md border sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.change-profil-image')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-md border sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-md border sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            @if(Auth::user()->role != "admin")
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow-md border sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
