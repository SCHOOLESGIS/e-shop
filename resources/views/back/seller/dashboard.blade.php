@extends('layouts.dashboard')

@section('content')
    <div class="mb-3 flex gap-3 flex flex-wrap">
        <div class="grow border w-[300px] h-[200px] rounded shadow relative flex flex-col items-center justify-center overflow-hidden text-4xl bg-blue-500/10">
            <div class="mb-3 text-lg absolute top-0 left-1 text-slate-400">Chiffre d'affaire</div>
            <img src="{{ asset('images/dash-bubble.png') }}" alt="" class="absolute right-[-40px] top-[-40px]">
            {{ $ca }} fcfa
        </div>
        <div class="grow border w-[300px] h-[200px] rounded shadow relative flex flex-col items-center justify-center overflow-hidden text-4xl bg-blue-500/10">
            <div class="mb-3 text-lg absolute top-0 left-1 text-slate-400">Revenue espéré</div>
            {{ $revenusEspere }} fcfa
        </div>
        <div class="w-[300px] h-[200px] rounded relative flex flex-col items-center justify-center overflow-hidden grow">
            @if (count($produits) > 3 )
                <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-3 border-b-2 border-red-500 gap-2 text-sm w-full">
                    <div class="">{{ $produits[0]->name }}</div>
                    <div class="text-end">{{ $produits[0]->price*count($produits[0]->commandeItems) }} fcfa</div>
                </div>
                <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-3 border-b-2 border-blue-500 gap-2 text-sm w-full">
                    <div class="">{{ $produits[1]->name }}</div>
                    <div class="text-end">{{ $produits[1]->price*count($produits[1]->commandeItems) }} fcfa</div>
                </div>
                <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-3 border-b-2 border-green-500 gap-2 text-sm w-full">
                    <div class="">{{ $produits[2]->name }}</div>
                    <div class="text-end">{{ $produits[2]->price*count($produits[2]->commandeItems) }} fcfa</div>
                </div>
                <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-3 border-b-2 border-amber-500 gap-2 text-sm w-full">
                    <div class="">{{ $produits[3]->name }}</div>
                    <div class="text-end">{{ $produits[3]->price*count($produits[3]->commandeItems) }} fcfa</div>
                </div>
            @else
                Aucun produit.
            @endif
        </div>
    </div>

    <div class="mb-3 text-lg">Statistiques des commandes</div>
    <div class="flex flex-wrap gap-3 w-full">
        <div class="w-[200px] h-[90px] rounded border grow flex items-center justify-center gap-3 shadow bg-amber-500/10">
            <div class="icon text-3xl text-amber-500 px-2 bg-amber-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                <i class="fi fi-sr-pending mt-2"></i>
            </div>
            <div class="text-xl text-slate-500"><strong>{{ count($commandes['pending']?? []) }}</strong> <span class="">En attentes</span></div>
        </div>
        <div class="w-[200px] h-[90px] rounded border grow flex items-center justify-center gap-3 shadow bg-green-500/10">
            <div class="icon text-3xl text-green-500 px-2 bg-green-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                <i class="fi fi-sr-sack-dollar"></i>
            </div>
            <div class="text-xl text-slate-500"><strong>{{ count($commandes['paid']?? []) }}</strong> <span class="">Payées</span></div>
        </div>
        <div class="w-[200px] h-[90px] rounded border grow flex items-center justify-center gap-3 shadow bg-blue-500/10">
            <div class="icon text-3xl text-blue-500 px-2 bg-blue-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                <i class="fi fi-sr-shipping-fast"></i>
            </div>
            <div class="text-xl text-slate-500"><strong>{{ count($commandes['shipped']?? []) }}</strong> <span class="">Livrées</span></div>
        </div>
        <div class="w-[200px] h-[90px] rounded border grow flex items-center justify-center gap-3 shadow bg-red-500/10">
            <div class="icon text-3xl text-red-500 px-2 bg-red-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                <i class="fi fi-sr-vote-nay"></i>
            </div>
            <div class="text-xl text-slate-500"><strong>{{ count($commandes['cancelled']?? []) }}</strong> <span class="">Annulée</span></div>
        </div>
    </div>
    <div class="mt-3 flex flex-wrap gap-3">
        <div class="w-[300px] grow border rounded shadow px-3 py-1 min-w-[400px] sm:overflow-x-scroll md:overflow-x-hidden">
            <div class="mb-3 text-lg">Produits vendeurs</div>
            <div class="grid grid-cols-3 grid-row-1 text-slate-800 py-2 border-b gap-2">
                <div class="">Libellé du produit</div>
                <div class="">Prix</div>
                <div class="">Boutique</div>
            </div>
            @forelse ($produits as $produit)
                <div class="grid grid-cols-3 grid-row-1 text-slate-600 py-4 border-b gap-2">
                    <div class="">{{ $produit->name }}</div>
                    <div class="">{{ $produit->price }} fcfa</div>
                    <div class="">{{ $produit->boutique->name }}</div>
                </div>
            @empty
                <div class="text-center grid grid-cols-1 grid-row-1 text-slate-600 py-4">
                    aucun produit trouvé.
                </div>
            @endforelse
        </div>
        <div class="w-[300px] grow border rounded shadow px-3 py-1 min-w-[300px] sm:overflow-x-scroll md:overflow-x-hidden">
            <div class="mb-3 text-lg">Meilleurs clients</div>
            <div class="grid grid-cols-3 grid-row-1 text-slate-800 py-2 border-b gap-3">
                <div class="">Nom d'utilisateurs</div>
                <div class="">Email</div>
                <div class="text-end">Nombre de commande</div>
            </div>

            @forelse ($clients as $client)
                <div class="grid grid-cols-3 grid-row-1 text-slate-600 py-4 border-b gap-3">
                    <div class="">{{ $client->name }}</div>
                    <div class="">{{ $client->email }}</div>
                    <div class="text-end">{{ count($client->commandes) }}</div>
                </div>
            @empty
                <div class="text-center grid grid-cols-1 grid-row-1 text-slate-600 py-4">
                    aucun client trouvé.
                </div>
            @endforelse
        </div>
    </div>
    <div class="mt-3 border rounded shadow relative pt-3" id="visitors-chart">
        <div class="mb-3 text-md absolute top-0 left-2 text-slate-500">Nombres de commandes par jour</div>
          <script
            src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
            integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
            crossorigin="anonymous"
          ></script>
          <script>
            // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
            // IT'S ALL JUST JUNK FOR DEMO
            // ++++++++++++++++++++++++++++++++++++++++++

            const visitors_chart_options = {
              series: [
                {
                  name: 'Nombre de commande - ' + new Date().getFullYear(),
                  data: @json($totaux),
                },
              ],
              chart: {
                height: 300,
                type: 'line',
                toolbar: {
                  show: false,
                },
              },
              colors: ['#0d6efd', '#adb5bd'],
              stroke: {
                curve: 'smooth',
              },
              grid: {
                borderColor: '#e7e7e7',
                row: {
                  colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                  opacity: 0.5,
                },
              },
              legend: {
                show: false,
              },
              markers: {
                size: 1,
              },
              xaxis: {
                categories: @json($jours),
              },
            };
            const visitors_chart = new ApexCharts(
        document.querySelector('#visitors-chart'),
        visitors_chart_options,
      );
      visitors_chart.render();
        </script>
    </div>
@endsection
