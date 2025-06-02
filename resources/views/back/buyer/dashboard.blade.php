@extends('layouts.dashboard')

@section('content')

    <div class="w-full flex flex-wrap gap-3">
        <div class="w-[300px] min-h-[125px] border shadow bg-blue-500/10 rounded relative overflow-hidden grow flex flex-col items-center justify-center overflow-hidden text-4xl text-slate-700">
            <div class="mb-3 text-lg absolute top-0 left-1 text-slate-400">Dépense</div>
            <img src="{{ asset('images/dash-bubble.png') }}" alt="" class="absolute right-[-40px] top-[-40px]">
            {{ $ca }} f cfa
            <img src="{{ asset('images/dash-bubble-2.png') }}" class="absolute w-full bottom-[-150px] right-[0]" alt="">
        </div>
        <div id="comandeNumbers" class="w-[300px] min-h-[125px] border shadow rounded bg-blue-500/10 relative overflow-hidden grow">
            <img src="{{ asset('images/dash-bubble-2.png') }}" class="absolute w-full bottom-[-120px] right-[0]" alt="">
        </div>
        <div class="w-[300px] min-h-[125px] border shadow rounded relative overflow-hidden grow p-3">
            <div class="flex flex-wrap gap-1">
                <div class="w-[150px] h-[125px] rounded border grow flex items-center justify-center gap-2 shadow bg-amber-500/10">
                    <div class="icon text-3xl text-amber-500 px-2 bg-amber-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                        <i class="fi fi-sr-pending mt-2"></i>
                    </div>
                    <div class="text-xl text-slate-500"><strong>{{ count($commandes['pending'] ?? []) }}</strong> <span class="">En attentes</span></div>
                </div>
                <div class="w-[150px] h-[125px] rounded border grow flex items-center justify-center gap-2 shadow bg-green-500/10">
                    <div class="icon text-3xl text-green-500 px-2 bg-green-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                        <i class="fi fi-sr-sack-dollar"></i>
                    </div>
                    <div class="text-xl text-slate-500"><strong>{{ count($commandes['paid'] ?? []) }}</strong> <span class="">Payées</span></div>
                </div>
                <div class="w-[150px] h-[125px] rounded border grow flex items-center justify-center gap-2 shadow bg-blue-500/10">
                    <div class="icon text-3xl text-blue-500 px-2 bg-blue-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                        <i class="fi fi-sr-shipping-fast"></i>
                    </div>
                    <div class="text-xl text-slate-500"><strong>{{ count($commandes['shipped']?? []) }}</strong> <span class="">Livrées</span></div>
                </div>
                <div class="w-[150px] h-[125px] rounded border grow flex items-center justify-center gap-2 shadow bg-red-500/10">
                    <div class="icon text-3xl text-red-500 px-2 bg-red-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                        <i class="fi fi-sr-vote-nay"></i>
                    </div>
                    <div class="text-xl text-slate-500"><strong>{{ count($commandes['cancelled']?? []) }}</strong> <span class="">Annulée</span></div>
                </div>
            </div>
        </div>
        <div class="w-full min-h-[100px] gap-2 flex items-center flex-wrap px-2 py-2 border rounded shadow bg-slate-100/50">
            <div id="visitors-chart" class="grow relative w-[200px] min-h-[100px] border rounded flex items-center justify-center gap-3 text-md text-slate-600">
                <div class="mb-3 text-sm absolute top-0 left-1 text-slate-400">Nombres de commandes par jour</div>

            </div>
            <div class="grow relative w-[200px] min-h-[150px] border rounded flex items-center justify-center gap-3 text-md text-slate-600">
                <div class="mb-3 text-sm absolute top-0 left-1 text-green-500"><i class="fi fi-rr-shopping-cart-check"></i></div>
                <strong class="text-3xl">{{ count($articles->items ?? []) }}</strong> Articles dans le panier
            </div>
            <div class="grow relative w-[200px] min-h-[150px] border rounded flex items-center justify-center gap-3 text-md text-slate-600">
                <div class="mb-3 text-sm absolute top-0 left-1 text-blue-500"><i class="fi fi-rr-shop"></i></div>
                <strong class="text-3xl">{{ count($boutiques ?? []) }}</strong> Boutiques visitées
            </div>
            <div class="grow relative w-[200px] min-h-[150px] border rounded flex items-center justify-center gap-3 text-md text-slate-600">
                <div class="mb-3 text-sm absolute top-0 left-1 text-red-400"><i class="fi fi-rr-heart"></i></div>
                <strong class="text-3xl">{{ $favoris ?? 0 }}</strong> Favoris
            </div>
        </div>
        <div class="flex flex-wrap gap-3 w-full">
            <div class="w-[300px] grow border rounded shadow px-3 py-1 min-w-[400px] sm:overflow-x-scroll md:overflow-x-hidden bg-slate-100/50">
                <div class="mb-3 text-lg">Boutiques récentes</div>
                <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-2 border-b gap-2">
                    <div class="">Nom de la boutique</div>
                    <div class="">Description</div>
                </div>
                @forelse ($boutiques as $boutique)
                    <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-4 border-b gap-2">
                        <div class="">{{ $boutique->name }}</div>
                        <div class="overflow-hidden text-nowrap text-ellipsis">{{ $boutique->description }}</div>
                    </div>
                @empty
                    <div class="text-center grid grid-cols-1 grid-row-1 text-slate-600 py-4">
                        aucune boutique trouvé.
                    </div>
                @endforelse
            </div>
            <div class="w-[300px] grow border rounded shadow px-3 py-1 min-w-[300px] sm:overflow-x-scroll md:overflow-x-hidden bg-slate-100/50">
                <div class="mb-3 text-lg">Produits récentes</div>
                <div class="grid grid-cols-3 grid-row-1 text-slate-800 py-2 border-b gap-3">
                    <div class="">Libellé</div>
                    <div class="">Description</div>
                    <div class="text-end">Prix</div>
                </div>
                @forelse ($commandesRecents as $commandes)
                    @foreach ($commandes->commandeItems as $items)
                        <div class="grid grid-cols-3 grid-row-1 text-slate-600 py-4 border-b gap-3">
                            <div class="">{{ $items->produit->name }}</div>
                            <div class="overflow-hidden text-nowrap text-ellipsis">{{ $items->produit->description }}</div>
                            <div class="text-end">{{ $items->produit->price }} f cfa</div>
                        </div>
                    @endforeach
                @empty
                    <div class="text-center grid grid-cols-1 grid-row-1 text-slate-600 py-4">
                        aucune commande trouvé.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
    <script>
        var options = {
        chart: {
            height: 300,
            type: "radialBar"
        },

        series: [@json(count($comNumber))],

        plotOptions: {
            radialBar: {
            hollow: {
                margin: 15,
                size: "65%"
            },
            color: ['#3B82F6'],
            track: {
                background: '#B6D0FB',
            },

            dataLabels: {
                showOn: "always",
                name: {
                offsetY: -10,
                show: true,
                color: "#888",
                fontSize: "13px"
                },
                value: {
                    color: "#111",
                    fontSize: "3rem",
                    show: true,
                    formatter: function (val) {
                        return Math.round(val);
                    }
                }
            }
            }
        },

        stroke: {
            lineCap: "round",
        },
        labels: ["Nombre de commande"]
        };

        var chart = new ApexCharts(document.querySelector("#comandeNumbers"), options);

        chart.render();

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
                height: 150,
                type: 'bar',
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
@endsection
