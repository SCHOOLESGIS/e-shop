@extends('layouts.dashboard')

@section('content')
    @php
        $as = [1, 2, 3, 4, 5]
    @endphp
    {{-- {{ dd($stats) }} --}}
    <div class="flex gap-3">
        <div class="w-[calc(100%-250px)] border rounded shadow px-2">2</div>
        <div class="w-[250px] border flex p-2 rounded flex flex-wrap gap-3 shadow">
            @foreach ($stats as $key => $stat)
                <div class="{{ $stat[1] }} w-full h-[100px] border grow rounded flex items-center justify-start gap-3 pl-3">
                    <div class="text-lg h-[50px] w-[50px] rounded-full flex items-center justify-center {{ $stat[3] }} {{ $stat[1] }}"><i class="{{ $stat[2] }}"></i></div> {{ count($stat[0]) }} - {{ $key }}
                </div>
            @endforeach
        </div>
    </div>
@endsection
