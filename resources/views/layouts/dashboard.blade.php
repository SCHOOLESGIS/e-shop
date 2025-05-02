<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>
<body>
<!-- resources/views/layouts/sidebar-layout.blade.php -->
@php
    $adminNavigations = [
        ['icon' => 'fi fi-rr-apps', 'link' => 'admin.dashboard.stats', 'libel' => 'Tableau de bord'],
        ['icon' => 'fi fi-rr-shop', 'link' => 'admin.boutique.index', 'libel' => 'Boutiques'],
        ['icon' => 'fi fi-rr-shopping-cart', 'link' => 'admin.commande.index', 'libel' => 'Commandes'],
        ['icon' => 'fi fi-rr-category', 'link' => 'admin.categorie.index', 'libel' => 'Categories'],
        ['icon' => 'fi fi-rr-supplier-alt', 'link' => 'admin.produit.index', 'libel' => 'Produits'],
        ['icon' => 'fi fi-rr-shopping-cart-add', 'link' => 'admin.panier.index', 'libel' => 'Paniers'],
        ['icon' => 'fi fi-rr-settings-sliders', 'link' => 'profile.edit', 'libel' => 'Paramètres'],
    ];

    $sellerNavigations = [
        ['icon' => 'fi fi-rr-apps', 'link' => 'seller.dashboard', 'libel' => 'Tableau de bord'],
        ['icon' => 'fi fi-rr-shopping-bag', 'link' => 'seller.boutique.index', 'libel' => 'Boutiques'],
        ['icon' => 'fi fi-rr-shopping-cart', 'link' => 'seller.commande.index', 'libel' => 'Commandes'],
        ['icon' => 'fi fi-rr-hr-group', 'link' => 'seller.commande.create', 'libel' => 'Clients'],
        ['icon' => 'fi fi-rr-settings-sliders', 'link' => 'profile.edit', 'libel' => 'Paramètres'],
    ];

    $buyerNavigations = [
        ['icon' => 'fi fi-rr-apps', 'link' => 'buyer.dashboard', 'libel' => 'Tableau de bord'],
        ['icon' => 'fi fi-rr-shopping-bag', 'link' => 'buyer.commande.index', 'libel' => 'Boutiques'],
        ['icon' => 'fi fi-rr-shopping-cart', 'link' => 'buyer.commande.index', 'libel' => 'Commandes'],
        ['icon' => 'fi fi-rr-hr-group', 'link' => 'seller.commande.create', 'libel' => 'Clients'],
        ['icon' => 'fi fi-rr-settings-sliders', 'link' => 'profile.edit', 'libel' => 'Paramètres'],
    ];

@endphp
<div class="w-full min-h-screen flex bg-white">
    <!-- Sidebar -->
    <div class="sticky top-0 shadow-[2px_0_10px_1px_rgba(0,0,0,0.05)] border border-2 w-[250px] h-screen bg-white hidden lg:flex flex-col gap-8">
        <div class="h-[80px] flex items-center justify-center border border-stone-200">
            <img class="w-[150px]" src="/logo/logo.png" alt="Logo">
        </div>
        <div class="w-full h-[calc(100vh-110px)] hover:overflow-y-scroll overflow-hidden pt-6 px-2">
            <ul class="flex flex-col gap-4">
                @if (Auth::user()->role == 'admin')
                    @foreach ($adminNavigations as $navigation)
                        <li>
                            <a href="{{ route($navigation['link']) }}" class="rounded bg-orange-50 hover:bg-orange-100 w-full text-start flex items-center gap-3 px-5 py-3 cursor-pointer {{ request()->is(ltrim($navigation['link'], '/')) ? 'bg-gray-100 font-semibold' : '' }}">
                                <i class="{{ $navigation['icon'] }}"></i>
                                <span class="font-normal text-gray-700">{{ $navigation['libel'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @elseif (Auth::user()->role == 'seller')
                    @foreach ($sellerNavigations as $navigation)
                        <li>
                            <a href="{{ route($navigation['link']) }}" class="rounded bg-orange-50 hover:bg-orange-100 w-full text-start flex items-center gap-3 px-5 py-3 cursor-pointer {{ request()->is(ltrim($navigation['link'], '/')) ? 'bg-gray-100 font-semibold' : '' }}">
                                <i class="{{ $navigation['icon'] }}"></i>
                                <span class="font-normal text-gray-700">{{ $navigation['libel'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @else
                    @foreach ($buyerNavigations as $navigation)
                        <li>
                            <a href="{{ route($navigation['link']) }}" class="rounded bg-orange-50 hover:bg-orange-100 w-full text-start flex items-center gap-3 px-5 py-3 cursor-pointer {{ request()->is(ltrim($navigation['link'], '/')) ? 'bg-gray-100 font-semibold' : '' }}">
                                <i class="{{ $navigation['icon'] }}"></i>
                                <span class="font-normal text-gray-700">{{ $navigation['libel'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="w-full px-2 mb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded w-full text-start flex items-center gap-3 px-5 py-3 border-orange-200 border-2 shadow-[0_0_10px_1px_rgba(0,0,0,0.1)] cursor-pointer">
                    <i class="fi fi-rr-sign-out-alt"></i>
                    <span class="font-medium text-slate-600">Se déconnecter</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full lg:w-[calc(100%-250px)] min-h-screen">
        <!-- Header -->
        <div class="z-10 sticky top-0 shadow-[4px_2px_10px_1px_rgba(0,0,0,0.05)] border border-2 h-[70px] bg-white flex items-center lg:justify-end justify-between px-5">
            <div class="text-blue-600 lg:hidden block flex gap-1">
                <img src="{{ asset('icons/form_logo.svg') }}" class="cursor-pointer shadow w-10" alt="Logo">
                <div class="text-2xl flex items-center cursor-pointer">
                    <i class="pi pi-align-justify" style="color: #3b82f6;"></i>
                </div>
            </div>
            <div class="flex gap-5">
                <div class="flex gap-4 items-center">
                    <div class="flex flex-col items-end text-black">
                        <span>{{ Auth::user()->name ?? 'Nom' }}</span>
                        <span class="text-gray-600 text-sm">{{ Auth::user()->role ?? 'Rôle' }}</span>
                    </div>
                    <img src="{{ asset('images/person_2.jpg') }}" class="w-12 h-12 rounded-full shadow-md border-2 border-orange-500" alt="Avatar">
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="w-full min-h-[calc(100vh-80px)] px-4 py-5">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
