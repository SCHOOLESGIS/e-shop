@extends('layouts.home')

@section('content')
<section class="site-banner jarallax min-height300 padding-large" style="padding-top:40px; height:200px; background: linear-gradient(0deg, rgba(0,0,0,0.4), rgba(0,0,0,0.4)),url(images/hero-image.jpg) no-repeat; background-position: center; background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-title" style="color: white;">{{ $boutique->name }}</h1>
        </div>
      </div>
    </div>
  </section>
  @if (count($boutique->produits) > 0)
  <div class="shopify-grid padding-large">
    <div class="container">
      <div class="row">
        <section id="selling-products" class="col-md-12 product-store">
            <form action="" class="d-flex rounded">
                <input type="text" class="border" placeholder="Rechercher" style="height: 50px;">
                <button type="submit" class="text-white rounded" style="height: 50px; width: 50px; background-color:rgb(42, 41, 40);">
                    <i class="fi fi-rr-category"></i>
                </button>
            </form>
          <div class="container">
            <div class="tab-content">
              <div id="all" data-tab-content class="active">
                <div class="row d-flex flex-wrap">

                    @foreach ($boutique->produits as $item)
                        <div class="product-item col-lg-4 col-md-6 col-sm-6" style="border-radius: 5px;">
                            <div class="image-holder" style="height: 300px; overflow: hidden; border-radius: 5px">
                                @if ($item->image)
                                    <img src="{{ asset('storage/'.$item->image) }}" style="object-fit: cover; object-position: center; width: 100%" alt="Books" class="product-image">
                                @else
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background-color:rgb(194, 191, 189); position: relative;">
                                        <img src="{{ asset("images/boutiques.jpg") }}" style="object-fit: cover; object-position: center; width: 100%" alt="Books" class="product-image">
                                        <div style="position: absolute; width: 100%; height: 100%; background-color:rgba(0, 0, 0, 0.4);"></div>
                                    </div>
                                @endif
                            </div>
                            <div class="cart-concern">
                            <div class="cart-button d-flex justify-content-between align-items-center" style="top: 40px;">
                                @auth
                                    <form action="{{ route('buyer.panierItem.store') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="decrease" value="0">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="produit_id" value="{{ $item->id }}">
                                        <button type="submit" class="btn-wrap cart-link d-flex align-items-center" style="padding: 10px 20px; border-radius: 20px; background-color: rgb(255, 179, 0); border: none; color: black;"><i class="fi fi-rr-shopping-cart-add"></i></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}">
                                        <button type="submit" class="btn-wrap cart-link d-flex align-items-center" style="padding: 10px 20px; border-radius: 20px; background-color: rgb(255, 179, 0); border: none; color: black;"><i class="fi fi-rr-shopping-cart-add"></i></i>
                                        </button>
                                    </a>
                                @endauth

                                @auth
                                    <form action="{{ route('buyer.favoris.store') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="produit_id" value="{{ $item->id }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                        <button type="submit" class="wishlist-btn" style="padding: 10px 20px; border-radius: 20px; background-color: rgb(255, 179, 0); border: none; color: black;">
                                            <i class="fi fi-rr-heart"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}">
                                        <button type="button" class="wishlist-btn" style="padding: 10px 20px; border-radius: 20px; background-color: rgb(255, 179, 0); border: none; color: black;">
                                            <i class="fi fi-rr-heart"></i>
                                        </button>
                                    </a>
                                @endauth
                            </div>
                            </div>
                            <div class="product-detail">
                            <h3 class="product-title">
                                <a href="{{ route('produit.show', ['produit' => $item->name]) }}">{{ $item->name }}</a>
                            </h3>
                            <div class="item-price text-primary">{{ $item->price }} fcfa</div>
                            </div>
                        </div>
                    @endforeach

                </div>
              </div>
              <div class="">
                {{-- {{ $produits->links('vendor.pagination.bootstrap-5') }} --}}
              </div>
          </div>
        </section>

      </div>
    </div>
  </div>
  @else
    <div class="" style="padding: 40px 40px; display: flex; align-items: center; justify-content: center;">
        Aucun produits en vente.
    </div>
  @endif
@endsection
