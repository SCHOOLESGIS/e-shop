@extends('layouts.home')

@section('content')
<section class="site-banner jarallax min-height300 padding-large" style="background: linear-gradient(0deg, rgba(0,0,0,0.4), rgba(0,0,0,0.4)),url(images/hero-image.jpg) no-repeat; background-position: center; background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-title" style="color: white;">Explorer les boutiques</h1>
        </div>
      </div>
    </div>
  </section>

  <div class="shopify-grid padding-large">
    <div class="container">
      <div class="row">
        <section id="selling-products" class="col-lg-12 col-md-12 product-store">
          <div class="container">
            <div class="widgets widget-menu">
                <div class="widget-search-bar">
                  <form action="" class="d-flex rounded">
                      <input type="text" class="border" placeholder="Rechercher une boutique" style="height: 50px;">
                      <button type="submit" class="text-white rounded" style="height: 50px; width: 50px; background-color:rgb(42, 41, 40);">
                          <i class="fi fi-rr-category"></i>
                      </button>
                  </form>
                </div>
              </div>
            <div class="tab-content">
              <div id="all" data-tab-content class="active">
                <div class="row d-flex flex-wrap">

                    @foreach ($boutiques as $item)
                        <div class="product-item col-lg-3 col-md-6 col-sm-6" style="border-radius: 5px; height: 200px;  box-shadow: O O 10px 1px rgba(0, 0, 0, 1); margin-bottom: 60px;">
                            <div class="image-holder" style="border-radius: 5px; height: 200px; overfolw: hidden;  box-shadow: O O 10px 1px rgba(23, 22, 22, 0.1);">
                                <img src="images/selling-products1.jpg" alt="Books" class="product-image border border-black" style="border-radius: 5px; height: 200px; object-fit: cover;">
                            </div>
                            <div class="product-detail">
                            <h3 class="product-title">
                                <a href="{{ route('boutique.show', [ 'boutique' => $item->slug]) }}">{{ $item->name }}</a>
                            </h3>
                            <div class=""><span style="font-weight: bold;">{{ count($item->produits) }}</span> Articles en vente.</div>
                            </div>
                        </div>
                    @endforeach

                </div>
              </div>
              <div class="">
                {{ $boutiques->links('vendor.pagination.bootstrap-5') }}
              </div>
          </div>
        </section>
      </div>
    </div>
  </div>
@endsection
