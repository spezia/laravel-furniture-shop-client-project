@extends('layouts.app')

@section('title', __('Impressions'))

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

<x-latest-reviews/>
<x-latest-products/>

<!-- Modal -->
<div class="modal fade" id="impressionModal" tabindex="-1" role="dialog" aria-labelledby="impressionModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-md-12">
                    <x-response-message/>
                </div>

                <div class="category-big-txt text-center">Ostavite vaš utisak</div>
                <div class="red-line"></div>

                <form id="reviewform" action="#" method="POST" class="impression-form"
                    data-url="{{ route('reviews.store') }}">
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
                        <button id="review-submit" class="red-btn with-border my-0">Ostavi komentar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection