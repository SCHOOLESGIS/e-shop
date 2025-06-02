@extends('layouts.home')

@section('content')
<section class="site-banner jarallax min-height300 padding-large" style="padding-top:40px; height:200px; background: linear-gradient(0deg, rgba(0,0,0,0.4), rgba(0,0,0,0.4)),url(images/hero-image.jpg) no-repeat; background-position: center; background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-title" style="color: white;">Produits</h1>
        </div>
      </div>
    </div>
  </section>

  <div class="shopify-grid padding-large">
    <div class="container">
      <div class="row">
        <section id="selling-products" class="col-md-9 product-store">
          <div class="container">
            <div class="tab-content">
              <div id="all" data-tab-content class="active">
                <div class="row d-flex flex-wrap">

                    @foreach ($produits as $item)
                        <div class="product-item col-lg-4 col-md-6 col-sm-6" style="border-radius: 5px;">
                            <div class="image-holder" style="height: 200px; overflow: hidden;">
                                @if ($item->image != null)
                                    <img src="{{ asset('storage/'.$item->image) }}" style="object-fit: cover; object-position: center; width: 100%" alt="Books" class="product-image">
                                @else
                                    <img src="{{ asset("images/produitbl.jpg") }}" style="object-fit: cover; object-position: center; width: 100%" alt="Books" class="product-image">
                                @endif
                            </div>
                            <div class="cart-concern">
                            <div class="cart-button d-flex justify-content-between align-items-center">
                                @auth
                                    <form action="{{ route('buyer.panierItem.store') }}" method="POST">
                                        @csrf
                                        @method('POST')
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
                                <a href="{{ route('produit.show', ['produit' => $item->id]) }}">{{ $item->name }}</a>
                            </h3>
                            <div class="item-price text-primary">{{ $item->price }} fcfa</div>
                            </div>
                        </div>
                    @endforeach

                </div>
              </div>
              <div class="">
                {{ $produits->links('vendor.pagination.bootstrap-5') }}
              </div>
          </div>
        </section>

        <aside class="col-md-3">
          <div class="sidebar">
            <div class="widgets widget-menu">
              <div class="widget-search-bar">
                <form action="" class="d-flex rounded">
                    <input type="text" class="border" placeholder="Rechercher" style="height: 50px;">
                    <button type="submit" class="text-white rounded" style="height: 50px; width: 50px; background-color:rgb(42, 41, 40);">
                        <i class="fi fi-rr-category"></i>
                    </button>
                </form>
              </div>
            </div>
            <div class="widgets widget-product-brands">
              <h5 class="widget-title">Boutiques</h5>
              <ul class="product-tags sidebar-list list-unstyled">
                <li class="tags-item">
                  <a href="">Nike</a>
                </li>
                <li class="tags-item">
                  <a href="">Adidas</a>
                </li>
                <li class="tags-item">
                  <a href="">Puma</a>
                </li>
                <li class="tags-item">
                  <a href="">Spike</a>
                </li>
              </ul>
            </div>
            <div class="widgets widget-price-filter">
              <h5 class="widget-title">Filtrer Par Prix</h5>
              <ul class="product-tags sidebar-list list-unstyled">
                <li class="tags-item">
                  <a href="">Less than $10</a>
                </li>
                <li class="tags-item">
                  <a href="">$10- $20</a>
                </li>
                <li class="tags-item">
                  <a href="">$20- $30</a>
                </li>
                <li class="tags-item">
                  <a href="">$30- $40</a>
                </li>
                <li class="tags-item">
                  <a href="">$40- $50</a>
                </li>
              </ul>
            </div>
          </div>
        </aside>

      </div>
    </div>
  </div>
@endsection
