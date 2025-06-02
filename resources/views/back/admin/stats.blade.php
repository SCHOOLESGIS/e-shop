@extends('layouts.dashboard')

@section('content')
    @php
        $as = [1, 2, 3, 4, 5]
    @endphp
    {{-- {{ dd($stats) }} --}}
    <div class="flex gap-3">
        <div class="w-[calc(100%-250px)] border rounded shadow px-2 py-2 flex flex-wrap grow">
            <div class="flex flex-wrap w-full gap-2">
                <div class="border w-[200px] h-[250px] rounded flex items-center justify-center text-xl text-slate-600 bg-blue-500/10 relative overflow-hidden grow">
                    <div class="text-3xl">{{ $ca }} f cfa</div>
                    <div class="absolute top-0 left-1 flex gap-3"><span><i class="fi fi-rr-chart-mixed-up-circle-dollar"></i></span> Chiffre d'affaire total</div>
                    <img src="{{ asset('/images/dash-bubble.svg') }}" alt="" class="absolute bottom-[-35px] right-[-25px]">
                </div>
                <div id="chart1" class="border w-[300px] h-[250px] rounded flex items-center justify-center text-xl text-slate-600 relative overflow-hidden grow">
                    <div class="absolute top-0 left-1 flex gap-3">Commandes de la semaine</div>
                </div>
            </div>
            <div class="text-lg">Statistiques des commandes</div>
            <div class="flex flex-wrap gap-3 w-full">
                <div class="w-[150px] h-[90px] rounded border grow flex items-center justify-center gap-3 shadow bg-amber-500/10">
                    <div class="icon text-3xl text-amber-500 px-2 bg-amber-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                        <i class="fi fi-sr-pending mt-2"></i>
                    </div>
                    <div class="text-xl text-slate-500"><strong>{{ count($commandesParStatus['pending']?? []) }}</strong> <span class="">En attentes</span></div>
                </div>
                <div class="w-[150px] h-[90px] rounded border grow flex items-center justify-center gap-3 shadow bg-green-500/10">
                    <div class="icon text-3xl text-green-500 px-2 bg-green-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                        <i class="fi fi-sr-sack-dollar"></i>
                    </div>
                    <div class="text-xl text-slate-500"><strong>{{ count($commandesParStatus['paid']?? []) }}</strong> <span class="">Payées</span></div>
                </div>
                <div class="w-[150px] h-[90px] rounded border grow flex items-center justify-center gap-3 shadow bg-blue-500/10">
                    <div class="icon text-3xl text-blue-500 px-2 bg-blue-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                        <i class="fi fi-sr-shipping-fast"></i>
                    </div>
                    <div class="text-xl text-slate-500"><strong>{{ count($commandesParStatus['shipped']?? []) }}</strong> <span class="">Livrées</span></div>
                </div>
                <div class="w-[150px] h-[90px] rounded border grow flex items-center justify-center gap-3 shadow bg-red-500/10">
                    <div class="icon text-3xl text-red-500 px-2 bg-red-500/30 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                        <i class="fi fi-sr-vote-nay"></i>
                    </div>
                    <div class="text-xl text-slate-500"><strong>{{ count($commandesParStatus['cancelled']?? []) }}</strong> <span class="">Annulée</span></div>
                </div>
            </div>
            <div class="w-full">
                <div class="text-lg">Meilleures ventes</div>
                <div class="w-full h-[200px] rounded relative flex flex-col items-center justify-center overflow-hidden grow">
                    @if (count($bestSeller) > 3 )
                        <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-3 border-b-2 border-red-500 gap-2 text-sm w-full">
                            <div class="">{{ $bestSeller[0]->name }}</div>
                            <div class="text-end">{{ $bestSeller[0]->price*count($bestSeller[0]->commandeItems) }} f cfa</div>
                        </div>
                        <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-3 border-b-2 border-blue-500 gap-2 text-sm w-full">
                            <div class="">{{ $bestSeller[1]->name }}</div>
                            <div class="text-end">{{ $bestSeller[1]->price*count($bestSeller[1]->commandeItems) }} f cfa</div>
                        </div>
                        <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-3 border-b-2 border-green-500 gap-2 text-sm w-full">
                            <div class="">{{ $bestSeller[2]->name }}</div>
                            <div class="text-end">{{ $bestSeller[2]->price*count($bestSeller[2]->commandeItems) }} f cfa</div>
                        </div>
                        <div class="grid grid-cols-2 grid-row-1 text-slate-600 py-3 border-b-2 border-amber-500 gap-2 text-sm w-full">
                            <div class="">{{ $bestSeller[3]->name }}</div>
                            <div class="text-end">{{ $bestSeller[3]->price*count($bestSeller[3]->commandeItems) }} f cfa</div>
                        </div>
                    @else
                        Aucun produit.
                    @endif
                </div>
            </div>
        </div>
        <div class="w-[250px] border flex p-2 rounded flex flex-wrap gap-3 shadow grow">
            <div class="w-full">
                <div id="comandeNumbers" class="w-full min-h-[125px] border shadow rounded bg-blue-500/10 relative overflow-hidden grow">
                    <img src="{{ asset('images/dash-bubble-2.png') }}" class="absolute w-full bottom-[-120px] right-[0]" alt="">
                </div>
            </div>
            @foreach ($stats as $key => $stat)
                <div class="{{ $stat[1] }} w-full h-[70px] border grow rounded flex items-center justify-start gap-3 pl-3">
                    <div class="text-lg h-[50px] w-[50px] rounded-full flex items-center justify-center {{ $stat[3] }} {{ $stat[1] }}"><i class="{{ $stat[2] }}"></i></div> {{ count($stat[0]) }} - {{ $key }}
                </div>
            @endforeach
        </div>
    </div>

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
        height: 200,
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
    document.querySelector('#chart1'),
    visitors_chart_options,
    );
    visitors_chart.render();


           var options = {
        chart: {
            height: 300,
            type: "radialBar"
        },

        series: [@json(count($stats['commandes'][0]))],

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
</script>
@endsection
