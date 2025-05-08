@extends('layouts.home')

@section('content')

<div class="hero relative">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Blog</h1>
                    <p class="mb-4">Découvrez nos articles, conseils et actualités autour de nos produits, tendances du marché et inspirations pour mieux consommer. Restez informé et faites des choix éclairés pour vos achats.</p>
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
                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="images/blog.png" class="img-fluid" style="width: 100%">
                </div>
            </div>

        </div>
    </div>
    <div class="wave">
        <img src="/images/wave.svg" alt="">
    </div>
</div>
<!-- End Hero Section -->



<!-- Start Blog Section -->
<div class="blog-section">
<div class="container">

    <div class="row">

        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <div class="post-entry">
                <a href="#" class="post-thumbnail"><img src="images/post-1.jpg" alt="Image" class="img-fluid"></a>
                <div class="post-content-entry">
                    <h3><a href="#">First Time Home Owner Ideas</a></h3>
                    <div class="meta">
                        <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <div class="post-entry">
                <a href="#" class="post-thumbnail"><img src="images/post-2.jpg" alt="Image" class="img-fluid"></a>
                <div class="post-content-entry">
                    <h3><a href="#">How To Keep Your Furniture Clean</a></h3>
                    <div class="meta">
                        <span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <div class="post-entry">
                <a href="#" class="post-thumbnail"><img src="images/post-3.jpg" alt="Image" class="img-fluid"></a>
                <div class="post-content-entry">
                    <h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
                    <div class="meta">
                        <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <div class="post-entry">
                <a href="#" class="post-thumbnail"><img src="images/post-1.jpg" alt="Image" class="img-fluid"></a>
                <div class="post-content-entry">
                    <h3><a href="#">First Time Home Owner Ideas</a></h3>
                    <div class="meta">
                        <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <div class="post-entry">
                <a href="#" class="post-thumbnail"><img src="images/post-2.jpg" alt="Image" class="img-fluid"></a>
                <div class="post-content-entry">
                    <h3><a href="#">How To Keep Your Furniture Clean</a></h3>
                    <div class="meta">
                        <span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <div class="post-entry">
                <a href="#" class="post-thumbnail"><img src="images/post-3.jpg" alt="Image" class="img-fluid"></a>
                <div class="post-content-entry">
                    <h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
                    <div class="meta">
                        <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <div class="post-entry">
                <a href="#" class="post-thumbnail"><img src="images/post-1.jpg" alt="Image" class="img-fluid"></a>
                <div class="post-content-entry">
                    <h3><a href="#">First Time Home Owner Ideas</a></h3>
                    <div class="meta">
                        <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <div class="post-entry">
                <a href="#" class="post-thumbnail"><img src="images/post-2.jpg" alt="Image" class="img-fluid"></a>
                <div class="post-content-entry">
                    <h3><a href="#">How To Keep Your Furniture Clean</a></h3>
                    <div class="meta">
                        <span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <div class="post-entry">
                <a href="#" class="post-thumbnail"><img src="images/post-3.jpg" alt="Image" class="img-fluid"></a>
                <div class="post-content-entry">
                    <h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
                    <div class="meta">
                        <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<!-- End Blog Section -->



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
                                        <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                    </blockquote>

                                    <div class="author-info">
                                        <div class="author-pic">
                                            <img src="images/person-1.png" alt="Maria Jones" class="img-fluid">
                                        </div>
                                        <h3 class="font-weight-bold">Maria Jones</h3>
                                        <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
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
                                        <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                    </blockquote>

                                    <div class="author-info">
                                        <div class="author-pic">
                                            <img src="images/person-1.png" alt="Maria Jones" class="img-fluid">
                                        </div>
                                        <h3 class="font-weight-bold">Maria Jones</h3>
                                        <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
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
                                        <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                    </blockquote>

                                    <div class="author-info">
                                        <div class="author-pic">
                                            <img src="images/person-1.png" alt="Maria Jones" class="img-fluid">
                                        </div>
                                        <h3 class="font-weight-bold">Maria Jones</h3>
                                        <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
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
