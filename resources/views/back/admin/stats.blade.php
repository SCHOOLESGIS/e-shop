@extends('layouts.dashboard')

@section('content')
    <div class="flex gap-3 border">
        <div class="w-[300px] border">1</div>
        <div class="w-[calc(100%-300px)] border">2</div>
    </div>
    {{ $products }}
@endsection
