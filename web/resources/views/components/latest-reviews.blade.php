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

    @if($reviews->count() > 0)
        <div class="container-small">
            <div data-aos="fade-up" data-aos-duration="500" id="impressions-carousel" class="carousel slide"
                data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($reviews as $item)
                        <div class="carousel-item {{ $loop->first? 'active' : '' }}">
                            <div class="impressions-holder">
                                <img class="quotes-left quotes" src="{{ asset('img/impressions/quote.png') }}" alt="quotes" />
                                <div>
                                    <div class="card-impression">
                                        {{ $item->message }}
                                    </div>
                                    <div class="card-buyer">{{ $item->name }}</div>
                                    <div class="cart-article">{{ $item->product }}</div>
                                </div>
                                <img class="quotes-right quotes" src="{{ asset('img/impressions/quote.png') }}" alt="quotes" />
                            </div>
                        </div>
                    @endforeach
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
    @endif
</section>