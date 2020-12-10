@extends('layouts.app')

@section('title', __('Home'))

@section('content')
<section class="background-image impressions-bcg">
    <div class="container-small">
        <div>
            <div class="carousel-small-txt">Quisque at orci felis.</div>
            <div class="carousel-big-txt">
                Reči koje govore sve
            </div>
            <div class="red-line"></div>
            <div class="medium-txt">Ponosni smo na svoje kupce, saradnja sa nama je prijatna.</div>
            <a href="products"><button class="red-btn">Pogledaj proizvode</button></a>
        </div>
    </div>
</section>

<section>
    <h1 data-aos="fade-up" data-aos-duration="500">Utisci zadovoljnih kupaca</h1>
    <div data-aos="fade-up" data-aos-duration="500" class="red-line"></div>

    <div class="about-txt-container">
        <p data-aos="fade-up" data-aos-duration="500">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In enim erat, blandit nec elit vitae, tristique
            ultricies libero. Duis elementum ante et lacinia interdum. Fusce laoreet gravida nisl, ac vulputate metus
            mollis in. Fusce facilisis est eget rutrum facilisis. Vestibulum aliquet, diam in lobortis vehicula, lacus
            justo rutrum ante, vel maximus sem eros at lectus. Integer sed urna lacus. Sed laoreet elit sit amet diam
            viverra commodo. Nunc imperdiet velit dictum, vehicula est a, imperdiet lacus. Nullam sit amet tellus
        </p>
    </div>

    <div class="text-center"><button data-toggle="modal" data-target="#impressionModal" data-aos="fade-up"
            data-aos-duration="500" class="red-btn with-border">Ostavi utisak</button></div>

    <div class="container-small">
        <div data-aos="fade-up" data-aos-duration="500" id="impressions-carousel" class="carousel slide"
            data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="impressions-holder">
                        <img class="quotes-left quotes" src="assets/dist/img/impressions/quote.png" alt="quotes" />
                        <div>
                            <div class="card-impression">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in ex a quam semper
                                faucibus. Maecenas vulputate gravida erat, at pellentesque felis placerat in.
                            </div>
                            <div class="card-buyer">Petar Petrovic</div>
                            <div class="cart-article">Naziv proizvoda</div>
                        </div>
                        <img class="quotes-right quotes" src="assets/dist/img/impressions/quote.png" alt="quotes" />
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="impressions-holder">
                        <img class="quotes-left quotes" src="assets/dist/img/impressions/quote.png" alt="quotes" />
                        <div>
                            <div class="card-impression">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in ex a quam semper
                                faucibus. Maecenas vulputate gravida erat, at pellentesque felis placerat in.
                            </div>
                            <div class="card-buyer">Petar Petrovic</div>
                            <div class="cart-article">Naziv proizvoda</div>
                        </div>
                        <img class="quotes-right quotes" src="assets/dist/img/impressions/quote.png" alt="quotes" />
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="impressions-holder">
                        <img class="quotes-left quotes" src="assets/dist/img/impressions/quote.png" alt="quotes" />
                        <div>
                            <div class="card-impression">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in ex a quam semper
                                faucibus. Maecenas vulputate gravida erat, at pellentesque felis placerat in.
                            </div>
                            <div class="card-buyer">Petar Petrovic</div>
                            <div class="cart-article">Naziv proizvoda</div>
                        </div>
                        <img class="quotes-right quotes" src="assets/dist/img/impressions/quote.png" alt="quotes" />
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#impressions-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#impressions-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


</section>

<section>
    <h1 data-aos="fade-up" data-aos-duration="500">Najnoviji Proizvodi</h1>
    <div data-aos="fade-up" data-aos-duration="500" class="red-line"></div>


    <div class="container-small">

        <div id="new-product-carousel" data-aos="fade-up" data-aos-duration="500"
            class="carousel slide carouse-top-arrows" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">

                    <div class="new-product-holder">
                        <div class="new-product">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-1.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 1</div>
                                <div class="product-price">RSD 10.000</div>
                            </div>
                        </div>
                        <div class="new-product d-none d-sm-block">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-2.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 2</div>
                                <div class="product-price">RSD 15.000</div>
                            </div>
                        </div>
                        <div class="new-product d-none d-sm-block">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-3.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 3</div>
                                <div class="product-price">RSD 75.000</div>
                            </div>
                        </div>
                        <div class="new-product d-none d-sm-block">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-4.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 4</div>
                                <div class="product-price">RSD 55.000</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel-item">

                    <div class="new-product-holder">
                        <div class="new-product d-none d-sm-block">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-1.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 1</div>
                                <div class="product-price">RSD 10.000</div>
                            </div>
                        </div>
                        <div class="new-product">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-2.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 2</div>
                                <div class="product-price">RSD 15.000</div>
                            </div>
                        </div>
                        <div class="new-product d-none d-sm-block">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-3.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 3</div>
                                <div class="product-price">RSD 75.000</div>
                            </div>
                        </div>
                        <div class="new-product d-none d-sm-block">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-4.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 4</div>
                                <div class="product-price">RSD 55.000</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel-item">

                    <div class="new-product-holder">
                        <div class="new-product d-none d-sm-block">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-1.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 1</div>
                                <div class="product-price">RSD 10.000</div>
                            </div>
                        </div>
                        <div class="new-product d-none d-sm-block">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-2.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 2</div>
                                <div class="product-price">RSD 15.000</div>
                            </div>
                        </div>
                        <div class="new-product">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-3.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 3</div>
                                <div class="product-price">RSD 75.000</div>
                            </div>
                        </div>
                        <div class="new-product d-none d-sm-block">
                            <div class="new-product-top">
                                <img src="assets/dist/img/home/product-4.jpg" alt="product image" />

                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">Stavi u korpu</button>
                                        <a href="single-product"><button class="white-btn">Pogledaj</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div class="product-name">Naziv Proizvoda Br. 4</div>
                                <div class="product-price">RSD 55.000</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <a class="carousel-control-prev" href="#new-product-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#new-product-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="impressionModal" tabindex="-1" role="dialog" aria-labelledby="impressionModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="category-big-txt text-center">Otavite vaš utisak</div>
                <div class="red-line"></div>

                <form action="{{ route('reviews.store') }}" method="POST" class="impression-form">
                    @csrf
                    <div class="contact-flex">
                        <input type="text" name="firstname" placeholder="Ime" required
                            class="contact-input impression-input" />

                        <input type="text" name="lastname" placeholder="Prezime" required
                            class="contact-input impression-input" />
                    </div>
                    <div class="contact-flex">
                        <input type="email" name="email" placeholder="Mail" required
                            class="contact-input impression-input" />

                        <input type="text" name="product" placeholder="Naziv proizvoda" required
                            class="contact-input impression-input" />
                    </div>

                    <textarea name="message" placeholder="Komentar" required="" class="contact-input contact-txt"></textarea>

                    <div class="text-right">
                        <button class="red-btn with-border my-0">Ostavi komentar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection