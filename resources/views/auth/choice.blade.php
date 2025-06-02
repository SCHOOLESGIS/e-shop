@extends('layouts.home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="bg-white border col-lg-6 d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <div class="buyer ">Voulez-vous acheter des articles ?</div>
                <h1>Acheteur</h1>
                <div class="buyer">
                    <a  href="{{ route('register', ['role' => 'seller']) }}">
                        <button class="btn btn-secondary" >Créer un compte d'acheteur</button>
                    </a>
                </div>
            </div>
            <div class="bg-white border col-lg-6 d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <div class="buyer">Souhaitez-vous créer vos boutiques et ventre des articles ?</div>
                <h1>Vendeur</h1>
                <div class="buyer">
                    <a  href="{{ route('register', ['role' => 'seller']) }}" method="GET">
                        <button class="btn btn-grey-outline" style="border: 2px solid #262525;">Créer un compte de vendeur</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
