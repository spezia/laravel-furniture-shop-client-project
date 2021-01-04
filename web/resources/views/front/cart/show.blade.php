@extends('layouts.app')

@section('title', __('Cart'))

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
                        <tr>
                            <td>
                                <div class="table-flex">
                                    <img class="cart-product-img" src="assets/dist/img/home/product-1.jpg"
                                        alt="product image" />
                                    <div class="cart-product-title">Naziv Proizvoda Br. 1</div>
                                </div>
                            </td>
                            <td>
                                <div class="table-flex">
                                    <div class="cart-price">RSD <input type="text" class="price-by-piect"
                                            readonly="readonly" value="10000" /></div>
                                </div>
                            </td>
                            <td>
                                <div class="table-flex">
                                    <div class="product-number">
                                        <button class="up-down minus">-</button>
                                        <input type="text" class="pieces" readonly="readonly" value="1" />
                                        <button class="up-down plus">+</button>
                                    </div>

                                </div>
                            </td>
                            <td>
                                <div class="table-flex">
                                    <div class="cart-price">RSD <input type="text" class="final-price"
                                            readonly="readonly" value="10000" /></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="table-flex">
                                    <img class="cart-product-img" src="assets/dist/img/home/product-2.jpg"
                                        alt="product image" />
                                    <div class="cart-product-title">Naziv Proizvoda Br. 1</div>
                                </div>
                            </td>
                            <td>
                                <div class="table-flex">
                                    <div class="cart-price">RSD <input type="text" class="price-by-piect"
                                            readonly="readonly" value="15000" /></div>
                                </div>
                            </td>
                            <td>
                                <div class="table-flex">
                                    <div class="product-number">
                                        <button class="up-down minus">-</button>
                                        <input type="text" class="pieces" readonly="readonly" value="1" />
                                        <button class="up-down plus">+</button>
                                    </div>

                                </div>
                            </td>
                            <td>
                                <div class="table-flex">
                                    <div class="cart-price">RSD <input type="text" class="final-price"
                                            readonly="readonly" value="15000" /></div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <div class="final-price-holder">
                    <div class="final-price-holder-row">
                        <div class="final-price-txt">Ukupno</div>
                        <div class="final-price-price">RSD 25000</div>
                    </div>
                    <div class="final-price-holder-row">
                        <div class="final-price-txt">Isporuka</div>
                        <div class="final-price-price">RSD 0</div>
                    </div>
                    <div class="final-price-holder-row">
                        <div class="final-price-txt">Svega</div>
                        <div class="final-price-price">RSD 25000</div>
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

                <form class="buyer-info">
                    <input type="text" name="first-name" placeholder="Ime" required class="contact-input" />
                    <input type="text" name="last-name" placeholder="Prezime" required class="contact-input" />
                    <input type="text" name="address" placeholder="Adresa" required class="contact-input" />
                    <input type="text" name="phone" placeholder="Telefon" required class="contact-input" />
                    <input type="email" name="email" placeholder="Mail" required class="contact-input" />

                    <div class="submit-holder">
                        <button type="button" class="prev-step"><label class="triangle"></label> Nazad</button>
                        <button class="next-step-btn">Sledeći korak</button>
                    </div>
                </form>
            </div>

            <div class="step-3">
                <div class="category-big-txt text-center">Podaci za plaćanje</div>
                <div class="red-line"></div>

                <div class="radio-holder">
                    <div class="radio-btn-holder">

                        <input type="radio" id="test1" name="paying-method" checked class="credit-card">
                        <label for="test1">Plaćanje karticom</label>
                    </div>
                    <div class="radio-btn-holder">

                        <input type="radio" id="test2" name="paying-method" class="paypal">
                        <label for="test2">Plaćanje PayPal</label>
                    </div>

                </div>
                <form class="payment-info">
                    <div class="card-info">
                        <input type="text" name="first-name" placeholder="Ime sa kartice" required
                            class="contact-input" />
                        <input type="text" name="last-name" placeholder="Prezime sa kartice" required
                            class="contact-input" />
                        <input type="text" name="card-number" placeholder="Broj sa kartice" required
                            class="contact-input" />
                        <div class="contact-flex">
                            <input type="text" name="date" placeholder="Datum isteka" required
                                class="contact-input small-input" />
                            <input type="text" name="security-code" placeholder="Sigurnosni kod" required
                                class="contact-input small-input" />
                        </div>
                    </div>

                    <div class="pp-info">
                        <input type="text" name="user-name" placeholder="Korisničko ime" 
                            class="contact-input" />
                        <input type="email" name="email" placeholder="Mail adresa"  class="contact-input" />
                    </div>


                    <div class="submit-holder">
                        <button type="button" class="prev-step"><label class="triangle"></label> Nazad</button>
                        <button class="next-step-btn">Sledeći korak</button>
                    </div>

                </form>
            </div>

            <div class="step-4">
                <div class="category-big-txt text-center">Uspešna kupovina</div>
                <div class="red-line"></div>

                <div class="confirmation-msg">
                    <div>
                        Vaša kupovina je uspešno obavljena, dostava će biti obavljena u roku od 10 dana.<br />
                        Hvala na kupovini!<br /><br />

                        <a href="{{ route('products.front.home') }}"><button class="red-btn with-border my-0">Pogledaj proizvode</button></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<x-reference-product/>
<!-- /.content -->
@endsection