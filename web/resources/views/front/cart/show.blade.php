@extends('layouts.app')

@section('title', __('Cart'))

@section('css-style')
@parent
<!-- Datepicker 1.5.0 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('content')
<section>
    <div class="container-small">
        <div class="cart-steps">
            <div id="step1" class="step active">
                <div class="step-number">1.</div>
                <div class="step-name">Vaša korpa</div>
            </div>
            <div id="step2" class="step">
                <div class="step-number">2.</div>
                <div class="step-name">Podaci za isporuku</div>
            </div>
            <div id="step3" class="step">
                <div class="step-number">3.</div>
                <div class="step-name">Podaci za plaćanje</div>
            </div>
            <div id="step4" class="step">
                <div class="step-number">4.</div>
                <div class="step-name">Uspešna kupovina</div>
            </div>
        </div>

        @if(session('cart') && count(session('cart')) > 0)

            <form id="js-order" action="#" type="POST" data-url="{{ route('cart.front.order') }}">
                @csrf
                <div class="steps-holder">
                    <div class="step-1 active">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Artikli</th>
                                    <th>Cena</th>
                                    <th>Količina</th>
                                    <th>Ukupno</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (session('cart') as $productId => $item)
                                    <tr>
                                        <td>
                                            <div class="table-flex">
                                                <img class="cart-product-img" src="{{ $item['product']->single_image }}" alt="{{ $item['name'] }}" />
                                                <div class="cart-product-title">{{ $item['name'] }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-flex">
                                                <div class="cart-price">{{ \config('custom.currency') }} <input type="text" class="price-by-piect"
                                                readonly="readonly" value="{{ $item['price'] }}" /></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-flex">
                                                <div class="product-number">
                                                    <button class="up-down minus">-</button>
                                                    <input type="text" name="quantity[{{ $productId }}]" class="pieces" readonly="readonly" value="{{ $item['quantity'] }}" />
                                                    <button class="up-down plus">+</button>
                                                </div>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-flex">
                                                <div class="cart-price">{{ \config('custom.currency') }} <input type="text" class="final-price"
                                                    readonly="readonly" value="{{ $item['price'] * $item['quantity'] }}" />
                                                    @php
                                                        $total = $total + ($item['price'] * $item['quantity']);
                                                    @endphp
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <div class="final-price-holder">
                            <div class="final-price-holder-row">
                                <div class="final-price-txt">Svega</div>
                                <div class="final-price-price">{{ \config('custom.currency') }} <label class="js-total-price">{{ $total }}</label></div>
                                <input type="hidden" class="js-total" name="total-price" value="{{ $total }}"/>
                            </div>
                            <div class="info">* u cenu je uračunat PDV</div>
                        </div>

                        <div class="text-center text-lg-right">
                            <button class="next-step next-step-btn">Sledeći korak</button>
                        </div>
                    </div>

                    <div class="step-2">
                        <div class="category-big-txt text-center">Podaci za isporuku</div>
                        <div class="red-line"></div>

                        <div class="buyer-info">
                            <input type="text" name="first-name" placeholder="Ime" required class="contact-input" />
                            <input type="text" name="last-name" placeholder="Prezime" required class="contact-input" />
                            <input type="text" name="address" placeholder="Adresa" required class="contact-input" />
                            <input type="text" name="phone" placeholder="Telefon" required class="contact-input" />
                            <input type="email" name="email" placeholder="Mail" required class="contact-input" />

                            <div class="submit-holder">
                                <button type="button" class="prev-step"><label class="triangle"></label> Nazad</button>
                                <button class="js-step1 next-step-btn">Sledeći korak</button>
                            </div>
                        </div>
                    </div>

                    <div class="step-3">
                        <div class="category-big-txt text-center">Podaci za plaćanje</div>
                        <div class="red-line"></div>

                        <div class="radio-holder">
                            <div class="radio-btn-holder">

                                <input type="radio" id="test1" name="paying-method" value="{{ $bank }}" checked class="credit-card">
                                <label for="test1">Plaćanje karticom</label>
                            </div>
                            <div class="radio-btn-holder">

                                <input type="radio" id="test2" name="paying-method" value="{{ $paypal }}" class="paypal">
                                <label for="test2">Plaćanje PayPal</label>
                            </div>

                        </div>
                        <div class="payment-info">
                            <div class="card-info">
                                <input type="text" name="card-first-name" placeholder="Ime sa kartice" required
                                    class="contact-input" />
                                <input type="text" name="card-last-name" placeholder="Prezime sa kartice" required
                                    class="contact-input" />
                                <input type="text" name="card-number" placeholder="Broj sa kartice" required
                                    class="contact-input" />
                                <div class="contact-flex">
                                    <input type="text" name="card-date" placeholder="Datum isteka" required
                                        class="date contact-input small-input" />
                                    <input type="text" name="card-security-code" placeholder="Sigurnosni kod" required
                                        class="contact-input small-input" />
                                </div>
                            </div>

                            <div class="pp-info">
                                <input type="text" name="paypal-username" placeholder="Korisničko ime" 
                                    class="contact-input" />
                                <input type="email" name="paypal-email" placeholder="Mail adresa"  class="contact-input" />
                            </div>


                            <div class="submit-holder">
                                <button type="button" class="prev-step"><label class="triangle"></label> Nazad</button>
                                <button class="js-step2 next-step-btn">Sledeći korak</button>
                            </div>

                        </div>
                    </div>

                    <div class="step-4">
                        <div class="category-big-txt text-center">Uspešna kupovina</div>
                        <div class="red-line"></div>

                        <div class="confirmation-msg">
                            <div>
                                Vaša kupovina je uspešno obavljena, dostava će biti obavljena u roku od 10 dana.<br />
                                Hvala na kupovini!<br /><br />

                                <a href="{{ route('products.front.home') }}" class="red-btn with-border my-0">Pogledaj proizvode</a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <x-response-message/>
                </div>
            </form>
        @else 
            <p>{{ trans('custom.cart_is_empty') }}</p>
        @endif
    </div>
</section>
<!-- /.content -->
@endsection

@section('javascript')
@parent
<script src="{{ asset('js/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection