@extends('layouts.home')

@section('content') <!-- End Header/Navigation -->

	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>A Propos</h1>
						<p class="mb-4">Nous sommes une équipe passionnée par l’innovation et le commerce en ligne. Notre mission est de vous offrir des produits de qualité à des prix compétitifs, avec un service client exceptionnel.</p>
						<p>
                            <a href="#" class="btn btn-secondary me-2">Explorer</a>
                            @auth
                              @if (Auth::user()->role == "admin")
                                  <a href="{{ route('buyer.commande.index') }}" class="btn btn-grey-outline" style="border: 2px solid #262525;">Créer une boutique</a>
                              @elseif(Auth::user()->role == "seller")
                                  <a href="{{ route('buyer.commande.index') }}" class="btn btn-grey-outline" style="border: 2px solid #262525;">Créer une boutique</a>
                              @else
                                  <a href="{{ route('buyer.commande.index') }}" class="btn btn-grey-outline" style="border: 2px solid #262525;">Passer une commande</a>
                              @endif
                            @else
                              <a href="{{ route('login') }}" class="btn btn-grey-outline" style="border: 2px solid #262525;">Créer ma boutique</a>
                            @endauth
                          </p>
                        </p>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="hero-img-wrap">
						<img src="images/couch.png" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->

	<!-- Start Why Choose Us Section -->
	<div class="why-choose-section">
		<div class="container">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-6">
					<h2 class="section-title">Why Choose Us</h2>
					<p>Nous mettons tout en œuvre pour offrir une expérience d’achat fluide, rapide et agréable. Notre engagement est fondé sur la qualité, la transparence et la confiance.</p>

					<div class="row my-5">
						<div class="col-6 col-md-6">
							<div class="feature">
								<div class="icon">
									<img src="images/truck.svg" alt="Image" class="imf-fluid">
								</div>
								<h3>Fast &amp; Free Shipping</h3>
								<p>Livraison rapide et gratuite à partir de 50€, avec un suivi en temps réel de votre commande.</p>
							</div>
						</div>

						<div class="col-6 col-md-6">
							<div class="feature">
								<div class="icon">
									<img src="images/bag.svg" alt="Image" class="imf-fluid">
								</div>
								<h3>Easy to Shop</h3>
								<p>Un site intuitif, un paiement sécurisé, et un processus de commande en seulement quelques clics.</p>
							</div>
						</div>

						<div class="col-6 col-md-6">
							<div class="feature">
								<div class="icon">
									<img src="images/support.svg" alt="Image" class="imf-fluid">
								</div>
								<h3>24/7 Support</h3>
								<p>Une équipe disponible à toute heure pour répondre à vos questions et résoudre vos problèmes.</p>
							</div>
						</div>

						<div class="col-6 col-md-6">
							<div class="feature">
								<div class="icon">
									<img src="images/return.svg" alt="Image" class="imf-fluid">
								</div>
								<h3>Hassle Free Returns</h3>
								<p>Retours simples et gratuits sous 14 jours si le produit ne correspond pas à vos attentes.</p>
							</div>
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

	<!-- Start Team Section -->
	<div class="untree_co-section">
		<div class="container">

			<div class="row mb-5">
				<div class="col-lg-5 mx-auto text-center">
					<h2 class="section-title">Our Team</h2>
				</div>
			</div>

			<div class="row">

				<!-- Start Column 1 -->
				<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
					<img src="images/person_1.jpg" class="img-fluid mb-5">
					<h3 clas><a href="#"><span class="">Lawson</span> Arnold</a></h3>
					<span class="d-block position mb-4">CEO, Founder, Atty.</span>
					<p>Avec plus de 10 ans d’expérience dans le e-commerce, Lawson a fondé cette entreprise pour rendre le shopping en ligne plus simple et plus humain.</p>
					<p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
				</div>
				<!-- End Column 1 -->

				<!-- Start Column 2 -->
				<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
					<img src="images/person_2.jpg" class="img-fluid mb-5">
					<h3 clas><a href="#"><span class="">Jeremy</span> Walker</a></h3>
					<span class="d-block position mb-4">CEO, Founder, Atty.</span>
					<p>Jeremy supervise la logistique et les opérations avec une précision exceptionnelle pour garantir la satisfaction client.</p>
					<p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
				</div>
				<!-- End Column 2 -->

				<!-- Start Column 3 -->
				<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
					<img src="images/person_3.jpg" class="img-fluid mb-5">
					<h3 clas><a href="#"><span class="">Patrik</span> White</a></h3>
					<span class="d-block position mb-4">CEO, Founder, Atty.</span>
					<p>Expert en expérience utilisateur, Patrik s’assure que notre boutique en ligne soit agréable et facile à utiliser.</p>
					<p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
				</div>
				<!-- End Column 3 -->

				<!-- Start Column 4 -->
				<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
					<img src="images/person_4.jpg" class="img-fluid mb-5">
					<h3 clas><a href="#"><span class="">Kathryn</span> Ryan</a></h3>
					<span class="d-block position mb-4">CEO, Founder, Atty.</span>
					<p>Kathryn dirige notre service client et veille à ce que chaque client soit écouté, compris et satisfait.</p>
					<p class="mb-0"><a href="#" class="more dark">Learn More <span class="icon-arrow_forward"></span></a></p>
				</div>
				<!-- End Column 4 -->

			</div>
		</div>
	</div>
	<!-- End Team Section -->

	<!-- Start Testimonial Slider -->
	<div class="testimonial-section before-footer-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 mx-auto text-center">
					<h2 class="section-title">Testimonials</h2>
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

							<div class="item">
								<div class="row justify-content-center">
									<div class="col-lg-8 mx-auto">

										<div class="testimonial-block text-center">
											<blockquote class="mb-5">
												<p>&ldquo;Service impeccable, livraison rapide et produits de qualité. Je recommande sans hésiter cette boutique en ligne !&rdquo;</p>
											</blockquote>

											<div class="author-info">
												<div class="author-pic">
													<img src="images/person-1.png" alt="Maria Jones" class="img-fluid">
												</div>
												<h3 class="font-weight-bold">Maria Jones</h3>
												<span class="position d-block mb-3">Cliente fidèle</span>
											</div>
										</div>

									</div>
								</div>
							</div>
							<!-- END item -->

							<div class="item">
								<div class="row justify-content-center">
									<div class="col-lg-8 mx-auto">

										<div class="testimonial-block text-center">
											<blockquote class="mb-5">
												<p>&ldquo;Très satisfait de mon expérience. Le support client est réactif et à l’écoute. Je referai une commande sans hésiter.&rdquo;</p>
											</blockquote>

											<div class="author-info">
												<div class="author-pic">
													<img src="images/person-1.png" alt="Maria Jones" class="img-fluid">
												</div>
												<h3 class="font-weight-bold">Karim B.</h3>
												<span class="position d-block mb-3">Client régulier</span>
											</div>
										</div>

									</div>
								</div>
							</div>
							<!-- END item -->

							<div class="item">
								<div class="row justify-content-center">
									<div class="col-lg-8 mx-auto">

										<div class="testimonial-block text-center">
											<blockquote class="mb-5">
												<p>&ldquo;Première commande sur ce site et je suis agréablement surprise par la qualité du service et des produits.&rdquo;</p>
											</blockquote>

											<div class="author-info">
												<div class="author-pic">
													<img src="images/person-1.png" alt="Maria Jones" class="img-fluid">
												</div>
												<h3 class="font-weight-bold">Élodie M.</h3>
												<span class="position d-block mb-3">Nouvelle cliente</span>
											</div>
										</div>

									</div>
								</div>
							</div>
							<!-- END item -->

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Testimonial Slider -->

@endsection
