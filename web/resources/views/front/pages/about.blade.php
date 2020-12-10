@extends('layouts.app')

@section('title', __('Home'))

@section('content')
<section class="background-image bcg-1">
    <div class="container-small">
        <div>
            <div class="carousel-small-txt">Quisque at orci felis.</div>
            <div class="carousel-big-txt">
                Ponosimo se svojim uspehom
            </div>
            <div class="red-line"></div>
            <div class="medium-txt">Pratite svoju strast, uspeh će vas platiti.</div>
            <a href="{{ route('page.contact') }}"><button class="red-btn">Kontaktirajte nas</button></a>
        </div>
    </div>
</section>

<section>
    <h1 data-aos="fade-up" data-aos-duration="500">O nama</h1>
    <div data-aos="fade-up" data-aos-duration="500" class="red-line"></div>

    <div class="about-txt-container">
        <p data-aos="fade-up" data-aos-duration="500">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In enim erat, blandit nec elit vitae, tristique
            ultricies libero. Duis elementum ante et lacinia interdum. Fusce laoreet gravida nisl, ac vulputate metus
            mollis
            in. Fusce facilisis est eget rutrum facilisis. Vestibulum aliquet, diam in lobortis vehicula, lacus justo
            rutrum
            ante, vel maximus sem eros at lectus. Integer sed urna lacus. Sed laoreet elit sit amet diam viverra
            commodo.
            Nunc imperdiet velit dictum, vehicula est a, imperdiet lacus. Nullam sit amet tellus ipsum.
        </p>
        <p data-aos="fade-up" data-aos-duration="500" class="mb-0">
            Quisque at orci felis. Phasellus at semper elit, ac aliquam nulla. Suspendisse egestas lorem non tristique
            cursus. Duis tristique nibh sit amet luctus interdum. Aliquam in est nulla. Proin consectetur sed magna ac
            venenatis. Pellentesque quis tortor a quam congue convallis quis sed elit. Aenean nec ornare metus, non
            ullamcorper magna. Sed bibendum consectetur hendrerit. Pellentesque mattis quis dui non lacinia.
        </p>
    </div>

</section>

<section class="background-image bcg-2">
    <div class="container-small">

        <div class="about-box-holder">
            <div data-aos="fade-up" data-aos-duration="500" class="about-box">
                <div class="about-box-title">Naša misija</div>
                <div class="about-box-text">
                    Fusce laoreet gravida nisl, ac vulputate metus mollis in. Fusce facilisis est eget rutrum facilisis.
                    Vestibulum aliquet, diam in lobortis vehicula, lacus justo rutrum ante, vel maximus sem eros at
                    lectus.
                </div>
            </div>
            <div data-aos="fade-up" data-aos-duration="500" class="about-box">
                <div class="about-box-title">Naša priča</div>
                <div class="about-box-text">
                    Fusce laoreet gravida nisl, ac vulputate metus mollis in. Fusce facilisis est eget rutrum facilisis.
                    Vestibulum aliquet, diam in lobortis vehicula, lacus justo rutrum ante, vel maximus sem eros at
                    lectus.
                </div>
            </div>
        </div>

        <div class="about-box-holder">
            <div data-aos="fade-up" data-aos-duration="500" class="about-box">
                <div class="about-box-title">Naš pristup</div>
                <div class="about-box-text">
                    Fusce laoreet gravida nisl, ac vulputate metus mollis in. Fusce facilisis est eget rutrum facilisis.
                    Vestibulum aliquet, diam in lobortis vehicula, lacus justo rutrum ante, vel maximus sem eros at
                    lectus.
                </div>
            </div>
            <div data-aos="fade-up" data-aos-duration="500" class="about-box">
                <div class="about-box-title">Naša filozofija</div>
                <div class="about-box-text">
                    Fusce laoreet gravida nisl, ac vulputate metus mollis in. Fusce facilisis est eget rutrum facilisis.
                    Vestibulum aliquet, diam in lobortis vehicula, lacus justo rutrum ante, vel maximus sem eros at
                    lectus.
                </div>
            </div>
        </div>

    </div>
</section>

<section>
    <h1 data-aos="fade-up" data-aos-duration="500">Naše reference</h1>
    <div data-aos="fade-up" data-aos-duration="500" class="red-line"></div>
    <x-latest-products :row="2"/>

</section>
<!-- /.content -->
@endsection