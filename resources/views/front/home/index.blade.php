@extends('layouts.home')

@section('content')
<!-- Start Hero Section -->
<div class="hero we-help-section relative wow fadeInUp" data-wow-delay="0.3s">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Propulsez votre marque avec<span class="d-block text-underlined"> e-Shop.</span></h1>
                    <p class="mb-4">Un écosystème e-commerce puissant, fluide et taillé pour la scalabilité. Créez, gérez, et vendez à l’échelle mondiale, sans friction.</p>
                    <p>
                        <a href="{{ route('boutique.index') }}" class="btn btn-secondary me-2">Explorer</a>

                        @auth
                            @if (Auth::user()->role == "admin")
                                <a href="{{ route('buyer.commande.index') }}" class="btn btn-grey-outline" style="border: 2px solid #262525;">Créer une boutique</a>
                            @elseif(Auth::user()->role == "seller")
                                <a href="{{ route('buyer.produit.index') }}" class="btn btn-grey-outline" style="border: 2px solid #262525;">Créer une boutique</a>
                            @else
                                <a href="{{ route('buyer.commande.index') }}" class="btn btn-grey-outline" style="border: 2px solid #262525;">Passer une commande</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-grey-outline" style="border: 2px solid #262525;">Créer ma boutique</a>
                        @endauth
                    </p>
                </div>
            </div>
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="imgs-grid">
                    <div class="grid grid-1"><img src="images/img-grid-1.jpg" alt="Untree.co"></div>
                    <div class="grid grid-2"><img src="images/img-grid-2.jpg" alt="Untree.co"></div>
                    <div class="grid grid-3"><img src="images/img-grid-3.jpg" alt="Untree.co"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="wave">
        <img src="/images/wave.svg" alt="">
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Product Section -->
<section id="platform-stats" class="py-5">
    <hr>
    <div class="container">
      <div class="row d-flex flex-wrap align-items-center justify-content-between text-center">

        <div class="col-md-3 col-sm-6 mb-4">
          <div class="icon-box">
            <i class="icon icon-users"></i>
            <h4 class="block-title d-flex flex-column align-items-center">
              <strong>+25 000</strong> Utilisateurs inscrits
            </h4>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <div class="icon-box">
            <i class="icon icon-cart"></i>
            <h4 class="block-title d-flex flex-column align-items-center">
              <strong>+100 000</strong> Commandes livrées
            </h4>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <div class="icon-box">
            <i class="icon icon-store"></i>
            <h4 class="block-title d-flex flex-column align-items-center">
              <strong>+1 200</strong> Boutiques actives
            </h4>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <div class="icon-box">
            <i class="icon icon-star"></i>
            <h4 class="block-title d-flex flex-column align-items-center">
              <strong>98%</strong> Taux de satisfaction
            </h4>
          </div>
        </div>

      </div>
    </div>
    <hr>
</section>

<div class="product-section">
    <div class="container">
        <div class="row">

            <!-- Start Column 1 -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">Produits les plus commandés</h2>
                <p class="mb-4">
                    Découvrez les articles préférés de nos clients ! Ces best-sellers allient qualité, tendance et excellent rapport qualité-prix. Ils sont en tête des ventes... et peut-être bientôt chez vous.
                </p>
                <p><a href="shop.html" class="btn">Explorer les produits</a></p>
            </div>
            <!-- End Column 1 -->

            <!-- Start Column 2 -->
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="cart.html">
                    <img src="images/product-1.png" class="img-fluid product-thumbnail">
                    <h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>

                    <span class="icon-cross">
                        <img src="images/cross.svg" class="img-fluid">
                    </span>
                </a>
            </div>
            <!-- End Column 2 -->

            <!-- Start Column 3 -->
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="cart.html">
                    <img src="images/product-2.png" class="img-fluid product-thumbnail">
                    <h3 class="product-title">Kruzo Aero Chair</h3>
                    <strong class="product-price">$78.00</strong>

                    <span class="icon-cross">
                        <img src="images/cross.svg" class="img-fluid">
                    </span>
                </a>
            </div>
            <!-- End Column 3 -->

            <!-- Start Column 4 -->
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="cart.html">
                    <img src="images/product-3.png" class="img-fluid product-thumbnail">
                    <h3 class="product-title">Ergonomic Chair</h3>
                    <strong class="product-price">$43.00</strong>

                    <span class="icon-cross">
                        <img src="images/cross.svg" class="img-fluid">
                    </span>
                </a>
            </div>
            <!-- End Column 4 -->

        </div>
    </div>
</div>
<!-- End Product Section -->

<!-- Start Why Choose Us Section -->
<div class="why-choose-section">
<div class="container">
    <div class="row justify-content-between">
        <div class="col-lg-6">
            <h2 class="section-title">Pourquoi nous choisir</h2>
            <p>
                Chez <strong>E-Shop</strong>, nous allions innovation, simplicité et engagement client. Chaque fonctionnalité est pensée pour améliorer votre expérience, chaque interaction vise l’excellence. Avec une plateforme fluide, un service fiable et des vendeurs de confiance, nous faisons du e-commerce une aventure sans friction.
            </p>
            <div class="row my-5">
                <div class="col-6 col-md-6">
                    <div class="feature">
                        <div class="icon">
                            <img src="images/truck.svg" alt="Livraison rapide" class="img-fluid">
                        </div>
                        <h3>Livraison rapide & gratuite</h3>
                        <p>Recevez vos commandes en un temps record, sans frais cachés. Grâce à nos partenaires logistiques, vos colis sont livrés rapidement, partout.</p>
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="feature">
                        <div class="icon">
                            <img src="images/bag.svg" alt="Facilité d'achat" class="img-fluid">
                        </div>
                        <h3>Une expérience d’achat simplifiée</h3>
                        <p>Parcourez, comparez et achetez en quelques clics. Notre interface intuitive rend le shopping en ligne plus simple que jamais.</p>
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="feature">
                        <div class="icon">
                            <img src="images/support.svg" alt="Support client 24/7" class="img-fluid">
                        </div>
                        <h3>Support client 24h/24</h3>
                        <p>Une question ? Un souci ? Notre équipe est disponible à toute heure, pour vous assister avec professionnalisme et réactivité.</p>
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="feature">
                        <div class="icon">
                            <img src="images/return.svg" alt="Retour sans tracas" class="img-fluid">
                        </div>
                        <h3>Retours simplifiés</h3>
                        <p>Changez d’avis en toute tranquillité. Notre politique de retour souple vous garantit une expérience d’achat sans stress.</p>
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <p><a href="{{ route('boutique.index') }}" class="btn btn-primary text-white">Explorer les boutiques</a></p>
                </div>

            </div>
        </div>

        <div class="col-lg-5">
            <div class="img-wrap">
                <img src="images/why-choose-us-img.jpg" alt="Image" class="img-fluid">
            </div>
        </div>

    </div>
</div>
</div>
<!-- End Why Choose Us Section -->

<!-- Start Testimonial Slider -->
<div class="testimonial-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-7 mx-auto text-center">
          <h2 class="section-title">Témoignages</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="testimonial-slider-wrap text-center">

            <div id="testimonial-nav">
              <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
              <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
            </div>

            <div class="testimonial-slider">

              <!-- Témoignage 1 -->
              <div class="item">
                <div class="row justify-content-center">
                  <div class="col-lg-8 mx-auto">
                    <div class="testimonial-block text-center">
                      <blockquote class="mb-5">
                        <p>&ldquo;Depuis que je vends sur E-Shop, mes revenus ont doublé. L’interface est fluide, le support est réactif, et mes clients sont satisfaits. Une vraie révolution pour les petits commerçants !&rdquo;</p>
                      </blockquote>
                      <div class="author-info">
                        <div class="author-pic">
                          <img src="images/person-1.png" alt="Karim Bensalem" class="img-fluid">
                        </div>
                        <h3 class="font-weight-bold">Karim Bensalem</h3>
                        <span class="position d-block mb-3">Fondateur de KB Créations</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Témoignage 2 -->
              <div class="item">
                <div class="row justify-content-center">
                  <div class="col-lg-8 mx-auto">
                    <div class="testimonial-block text-center">
                      <blockquote class="mb-5">
                        <p>&ldquo;En tant qu'acheteuse régulière, j’apprécie la rapidité de livraison et la qualité des produits. Les retours sont simples et j’ai toujours trouvé ce que je cherchais. Je recommande à 100 %!&rdquo;</p>
                      </blockquote>
                      <div class="author-info">
                        <div class="author-pic">
                          <img src="images/person_2.jpg" alt="Sophie Morel" class="img-fluid">
                        </div>
                        <h3 class="font-weight-bold">Sophie Morel</h3>
                        <span class="position d-block mb-3">Cliente fidèle depuis 2022</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Témoignage 3 -->
              <div class="item">
                <div class="row justify-content-center">
                  <div class="col-lg-8 mx-auto">
                    <div class="testimonial-block text-center">
                      <blockquote class="mb-5">
                        <p>&ldquo;Notre marque a gagné en visibilité grâce à E-Shop. Le tableau de bord vendeur est ultra-complet et les outils marketing intégrés m’ont permis de booster mes ventes.&rdquo;</p>
                      </blockquote>
                      <div class="author-info">
                        <div class="author-pic">
                          <img src="images/person_3.jpg" alt="Léa Dumont" class="img-fluid">
                        </div>
                        <h3 class="font-weight-bold">Léa Dumont</h3>
                        <span class="position d-block mb-3">Responsable e-commerce, BioZen</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div> <!-- .testimonial-slider -->

          </div>
        </div>
      </div>
    </div>
  </div>
<!-- End Testimonial Slider -->

@endsection
