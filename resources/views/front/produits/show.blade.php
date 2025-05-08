@extends('layouts.home')

@section('content')
    <div class="container">
        <div class="row g-3 w-100 min-vh-50 flex-wrap">
            <div class="col-md-6 col-lg-6" style="overflow: hidden;">
                <div class="position-relative d-flex align-items-center justify-content-center bg-light border rounded border h-100 p-3" style="height: 600px; width: 100%;">
                    <a href="{{ route('boutique.show', ['boutique' => $produit->boutique->slug]) }}"
                       class="btn btn-sm btn-danger position-absolute top-0 start-0 m-2 shadow-sm">
                        Retour
                    </a>
                    @if($produit->image != null)
                        <img style="width: 100%;" src="{{ asset('storage/'.$produit->image) }}" alt="">
                    @else
                        <div>500 X 500</div>
                    @endif
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="d-flex flex-column">
                    <h1 class="display-6 mb-4">{{ $produit->name }}</h1>

                    <div class="mb-4 fs-5 text-muted">
                        Catégorie :
                        <span class="badge bg-success bg-opacity-10 text-success">
                            {{ $produit->categorie->name }}
                        </span>
                    </div>

                    <div class="mb-2 fs-5 text-dark">Description :</div>
                    <div class="mb-4 text-muted">
                        {{ $produit->description }}
                    </div>

                    <div class="mb-3 fs-5 text-dark">
                        Boutique :
                        <span class="text-muted">{{ $produit->boutique->name }}</span>
                    </div>

                    <div class="mb-4 fs-5 text-muted">
                        Chez <strong>{{ $produit->boutique->name }}</strong> {{ $produit->boutique->description }}
                    </div>

                    <div class="mb-4 fs-5 text-dark">
                        Créé le :
                        <span class="text-muted">{{ $produit->created_at }}</span>
                    </div>

                    <form action="{{ route('buyer.panierItem.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                        <button type="submit" class="btn btn-warning fw-semibold shadow d-flex align-items-center gap-2">
                            <i class="fi fi-rr-shopping-cart-add"></i> Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
