@extends('layouts.app')

@section('title', __('Home'))

@section('content')

<!-- Main content -->
@if($categoriesFirst->count() > 0)
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach ($categoriesFirst as $category)
            <div class="carousel-item {{ $loop->first? 'active' : '' }}">
                <div class="container-small">
                    <div class="carousel-content">
                        <div>
                            <div class="carousel-small-txt">{{ $category->name }}</div>
                            <div class="carousel-big-txt">
                                Otkrijte različit dizajn<br />
                                modernog nameštaja
                            </div>
                            <div class="red-line"></div>
                            <div class="medium-txt">{{ $category->description }}</div>
                            <a href="{{ route('categories.front.show', ['slug' => $category->slug]) }}"><button class="red-btn">Saznaj Više</button></a>
                        </div>
                    </div>
                </div>
                <img class="carousel-img" src="{{ $category->products->first()->single_image }}" alt="{{ $category->name }}">
            </div>
            @endforeach
        </div>
    </div>
@endif

@if($categoriesLast->count() > 0)
    <div data-aos="fade-up" data-aos-duration="500" class="d-sm-flex">
        @foreach ($categoriesLast as $category)
            <div data-aos-offset="500" class="home-3-1-content">
                <div class="hover-box">
                    <div class="white-frame"></div>
                </div>
        
                <div class="hoverbox-txt">
                    <div>
                        <h2>{{ $category->name }}</h2>
                        <div class="medium-txt">{{ $category->description }}</div>
                        <a href="{{ route('categories.front.show', ['slug' => $category->slug]) }}"><button class="red-btn">Saznaj Više</button></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<x-latest-products/>

<section class="background-image home-livingroom" data-aos="fade-up" data-aos-duration="500">
    <div class="container-small">
        <div class="text-right">
            <div class="carousel-small-txt" data-aos="fade-up" data-aos-duration="500">Konstaninin design Mobex group
            </div>
            <div class="carousel-big-txt" data-aos="fade-up" data-aos-duration="500">
                Odabrani nameštaj, može i po meri!
            </div>
            <div class="red-line" data-aos="fade-up" data-aos-duration="500"></div>
            <div class="medium-txt" data-aos="fade-up" data-aos-duration="500">
                Pored široke palete naših gotovih proizvoda, bavimo se<br class="d-none d-sm-block" />
                izradom nameštaj koji ima mere samo iz Vašeg kutka.
            </div>
            <a href="{{ route('page.contact') }}"><button class="red-btn" data-aos="fade-up" data-aos-duration="500">{{ __('custom.contact') }}</button></a>
        </div>
    </div>
</section>

<x-discount-product/>

<section class="background-image home-kitchen" data-aos="fade-up" data-aos-duration="500">
    <div class="container-small">
        <div class="d-sm-flex justify-content-between">

            @if($reviews->count() > 0)
                <div class="home-card">
                    <h2 data-aos="fade-up" data-aos-duration="500">Utisci zadovoljnih kupaca</h2>
                    <div class="red-line" data-aos="fade-up" data-aos-duration="500"></div>
    
                    <div id="impression-carousel" data-aos="fade-up" data-aos-duration="500"
                        class="carousel slide carouse-bottom-arrows" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($reviews as $item)
                                <div class="carousel-item {{ $loop->first? 'active' : '' }}">
                                    <div class="card-impression">
                                        {{ $item->message }}
                                    </div>
                                    <div class="card-buyer">{{ $item->name }}</div>
                                    <div class="cart-article">{{ $item->product }}</div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#impression-carousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#impression-carousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                
                    <a href="{{ route('page.impressions') }}"><button class="red-btn">Saznaj više</button></a>
                @endif
            </div>
            <div class="home-card">
                <h2 data-aos="fade-up" data-aos-duration="500">O nama</h2>
                <div class="red-line" data-aos="fade-up" data-aos-duration="500"></div>

                <div class="card-about-txt" data-aos="fade-up" data-aos-duration="500">
                    Morbi mauris eros, blandit ut eleifend tempor, condimentum non tellus. Quisque lobortis lorem
                    fringilla, volutpat sem vitae, ultricies ligula. Aenean mattis libero dapibus, consequat dolor quis,
                    hendrerit mi. Donec ullamcorper malesuada ante, non condimentum velit tristique ac. Orci varius
                    natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                </div>
                <a href="{{ route('page.about') }}"><button class="red-btn">Saznaj više</button></a>

            </div>


        </div>
    </div>
</section>
<!-- /.content -->
@endsection
