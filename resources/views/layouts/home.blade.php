<!-- /*
* Bootstrap 5
* Template Name: Furni
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
        <!-- Fichiers locaux depuis /public -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/normalize.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('icomoon/icomoon.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/vendor.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/style-ultra.css') }}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}" />

        <!-- Liens CDN (inchangés car ils pointent déjà vers des URLs externes) -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="all" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

        <!-- Scripts -->
		<title>e-shop</title>

        <script src="{{ asset('assets/js/wow.min.js') }}"></script>
        <script>
            new WOW().init();
          </script>
	</head>

	<body>
        @php
        $classes = ($active ?? false) ? 'active' : '';
        @endphp
		<!-- Start Header/Navigation -->
		<nav class="px-2 custom-navbar navbar navbar navbar-expand-md" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand text-primary" href="{{ route('home.index') }}"><img class="logo" src="{{ asset('logo/logo.png') }}" alt=""><span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
							<a class="nav-link text-primary" href="{{ route('home.index') }}">Acceuil</a>
						</li>
						<li class=" {{ request()->routeIs('boutique.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('boutique.index') }}">Boutiques</a></li>
						<li class=" {{ request()->routeIs('produit.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('produit.index') }}">Produits</a></li>
						<li class=" {{ request()->routeIs('home.about') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home.about') }}">A propos</a></li>
						<li class=" {{ request()->routeIs('home.contact') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home.contact') }}">Nous contactez</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav ms-5">
                        @auth
						    <li class=""><a class="nav-link btn btn-secondary"
                                @if (Auth::user()->role == "admin")
                                    href="{{ route('admin.dashboard.stats') }}"
                                @elseif(Auth::user()->role == "seller")
                                    href="{{ route('seller.boutique.index') }}"
                                @else
                                    href="{{ route('buyer.dashboard.index') }}"
                                @endif
                                >{{ Auth::user()->name }} - Dashboard</a></li>
                        @else
                        @endauth

                        @auth
                            <li class="others-action {{ request()->routeIs('home.panier') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home.panier') }}" style="position: relative;">@if ($qte > 0 )<div style="position: absolute; top: -5px; right: -2px; font-weight: bolder; font-size: 1.1rem">{{ $qte }}</div>@endif<img src="{{ asset('images/cart.svg') }}"></a></li>
                        @else
                            <li class="others-action {{ request()->routeIs('login') ? 'active' : '' }}" ><a class="nav-link" href="{{ route('login') }}"  style="padding: 5px 10px 0px 10px; background-color: rgb(255, 255, 255); border-radius: 5px; margin-top: 5px; margin-left: 15px;" ><i class="fi fi-rr-circle-user" style="color: black !important; font-size: 1.25rem; margin: 0px !important;"></i></a></li>
                            <li class="others-action {{ request()->routeIs('choice') ? 'active' : '' }}"><a class="nav-link" href="{{ route('choice') }}" style="padding: 2px 20px; background-color: rgb(255, 255, 255); border-radius: 5px; margin-top: 5px; margin-left: 5px;"> <span>Sign Up</span></a></li>
                        @endauth
					</ul>
				</div>
			</div>

		</nav>
		<!-- End Header/Navigation -->

        @yield('content')

		<!-- Start Footer Section -->
        <footer class="wow fadeInUp px-3 footer-section" data-wow-delay="0.3s">
            <div class="container relative">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="subscription-form">
                            <h3 class="d-flex align-items-center">
                                <span class="me-1">
                                    <img src="{{ asset('images/envelope-outline.svg') }}" alt="Icône d'enveloppe" class="img-fluid">
                                </span>
                                <span class="subscribe">Abonnez-vous à notre newsletter</span>
                            </h3>

                            <form action="#" class="row g-3">
                                <div class="col-auto">
                                    <input type="text" class="form-control" placeholder="Entrez votre nom">
                                </div>
                                <div class="col-auto">
                                    <input type="email" class="form-control" placeholder="Entrez votre email">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary send-plane">
                                        <span class="fa fa-paper-plane"></span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="row g-5 mb-5">
                    <div class="col-lg-4">
                        <div class="mb-4 footer-logo-wrap">
                            <a class="navbar-brand text-primary" href="{{ route('home.index') }}">
                                <img class="logo2" src="{{ asset('logo/logo.png') }}" alt="Logo E-Shop"><span>.</span>
                            </a>
                        </div>
                        <p class="mb-4"> E-Shop, votre partenaire en ligne pour des produits variés et de qualité. Mode, high-tech, maison... notre équipe s'engage à vous offrir un service fiable et rapide.</p>

                        <ul class="list-unstyled custom-social">
                            <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                            <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                            <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                        </ul>
                    </div>

                    <div class="col-lg-8">
                        <div class="row links-wrap">
                            <div class="col-6 col-sm-6 col-md-3">
                                <ul class="list-unstyled">
                                    <li><a href="#">À propos</a></li>
                                    <li><a href="#">Nos services</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>

                            <div class="col-6 col-sm-6 col-md-3">
                                <ul class="list-unstyled">
                                    <li><a href="#">Support client</a></li>
                                    <li><a href="#">Centre d'aide</a></li>
                                    <li><a href="#">Chat en direct</a></li>
                                </ul>
                            </div>

                            <div class="col-6 col-sm-6 col-md-3">
                                <ul class="list-unstyled">
                                    <li><a href="#">Recrutement</a></li>
                                    <li><a href="#">Notre équipe</a></li>
                                    <li><a href="#">Direction</a></li>
                                    <li><a href="#">Politique de confidentialité</a></li>
                                </ul>
                            </div>

                            <div class="col-6 col-sm-6 col-md-3">
                                <ul class="list-unstyled">
                                    <li><a href="#">Chaise Nordique</a></li>
                                    <li><a href="#">Kruzo Aero</a></li>
                                    <li><a href="#">Chaise ergonomique</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top copyright">
                    <div class="row pt-4">
                        <div class="col-lg-6">
                            <p class="mb-2 text-center text-lg-start">
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script>. Tous droits réservés. — Développé avec ❤️ par l'équipe <strong>E-Shop</strong>.
                            </p>
                        </div>

                        <div class="col-lg-6 text-center text-lg-end">
                            <ul class="list-unstyled d-inline-flex ms-auto">
                                <li class="me-4"><a href="#">Conditions générales</a></li>
                                <li><a href="#">Politique de confidentialité</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </footer>
		<!-- End Footer Section -->


		<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/carousel.js"></script>
	</body>

</html>
