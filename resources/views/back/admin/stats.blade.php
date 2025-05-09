@extends('layouts.dashboard')

@section('content')
    @php
        $as = [1, 2, 3, 4, 5]
    @endphp
    {{-- {{ dd($stats) }} --}}
    <div class="flex gap-3">
        <div class="w-[calc(100%-250px)] border rounded shadow px-2 py-2 flex gap-2 flex-wrap grow">
            <div class="flex flex-wrap w-full gap-2">
                <div class="border w-[200px] h-[250px] rounded flex items-center justify-center text-xl text-slate-600 bg-blue-500/10 relative overflow-hidden grow">
                    <div class="text-2xl">{{ $ca }} f cfa</div>
                    <div class="absolute top-0 left-1 flex gap-3"><span><i class="fi fi-rr-chart-mixed-up-circle-dollar"></i></span> Chiffre d'affaire total</div>
                    <img src="{{ asset('/images/dash-bubble.svg') }}" alt="" class="absolute bottom-[-35px] right-[-25px]">
                </div>
                <div id="chart1" class="border w-[300px] h-[250px] rounded flex items-center justify-center text-xl text-slate-600 relative overflow-hidden grow">
                </div>
            </div>
            <div class=""></div>
        </div>
        <div class="w-[250px] border flex p-2 rounded flex flex-wrap gap-3 shadow grow">
            @foreach ($stats as $key => $stat)
                <div class="{{ $stat[1] }} w-full h-[90px] border grow rounded flex items-center justify-start gap-3 pl-3">
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
        categories: [],
      },
    };
    const visitors_chart = new ApexCharts(
    document.querySelector('#chart1'),
    visitors_chart_options,
    );
    visitors_chart.render();
</script>
@endsection
