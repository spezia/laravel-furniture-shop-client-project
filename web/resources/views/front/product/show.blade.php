@extends('layouts.app')

@section('title', $product->name)

@section('content')
<section>
    <div class="container-small">
        <div class="breadcrumb"><a href="{{ route('pages.front.home') }}">Početna</a>
            /<a href="{{ route('categories.front.show', ['slug' => $product->category->slug]) }}">{{ $product->category->name }}</a>
            /<span>{{ $product->name }}</span>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div data-aos="fade-up" data-aos-duration="500">

                    <x-response-message/>

                    <div class="imglist">
                        <div class="main-thumb">
                            <a href="{{ $product->single_image }}" data-fancybox="preview" data-width="1500"
                                data-height="1000">
                                <img src="{{ $product->single_image }}" />
                            </a>
                        </div>

                        @if($product->getMedia($collection)->count() > 0)
                        <div class="small-thumbs">
                            @foreach($product->getMedia($collection) as $media)
                                <a class="thumb" href="{{ $media->getUrl() }}" data-fancybox="preview"
                                    data-width="1500" data-height="1000">
                                     <img src="{{ $media->getUrl('thumb') }}" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div data-aos="fade-up" data-aos-duration="500" class="product-title">{{ $product->name }}</div>
                <div data-aos="fade-up" data-aos-duration="500" class="product-code">ŠIFRA ARTIKLA: {{ $product->code }}</div>

                @if($product->properties)
                <div class="product-info">
                    <div data-aos="fade-up" data-aos-duration="500" class="product-details">
                        @foreach($product->properties_array as $key => $property)
                        <div class="product-dimension">
                            <span>{{ $property[0] }}</span>
                            <span>{{ $property[1] }}</span>
                        </div>
                        @endforeach
                    </div>
                    {{-- <div data-aos="fade-up" data-aos-duration="500" class="product-colors">

                        <div class="color-title">Dezen</div>

                        <div class="colors-holder">
                            <div class="color-holder active">
                                <div class="color brown"></div>
                                <div class="color-name">Braon</div>
                            </div>
                            <div class="color-holder">
                                <div class="color black"></div>
                                <div class="color-name">Crna</div>
                            </div>
                            <div class="color-holder">
                                <div class="color red"></div>
                                <div class="color-name">Crvena</div>
                            </div>
                        </div>

                    </div> --}}
                </div>
                @endif

                @if($product->discounts->count() > 0)
                    <div data-aos="fade-up" data-aos-duration="500" class="discount-holder">
                        @php $discount = $product->discounts->first() @endphp
                        <div class="discount-tag">
                            {{ $discount->discount }}
                        </div> 
                            Važi od <span>{{ $discount->from->format('d.m.Y') }}.</span> do <span>{{ $discount->to->format('d.m.Y') }}.</span>
                    </div>
                    
                    <div data-aos="fade-up" data-aos-duration="500" class="price">
                        <div class="current-price">{{ floatval($discount->new_price) .' '. \config('custom.currency') }}</div>
                        <div class="old-price">{{ floatval($product->price) .' '. \config('custom.currency')  }}</div>
                    </div>
                @else 
                    <div data-aos="fade-up" data-aos-duration="500" class="price">
                        <div class="current-price">{{ floatval($product->price) .' '. \config('custom.currency')  }}</div>
                    </div>
                @endif

                <div data-aos="fade-up" data-aos-duration="500" class="product-buy">
                    <form id="js-cartshop">
                        @csrf
                        <div class="product-number">
                            <button class="up-down minus">-</button>
                            <input type="text" name="quantity" class="pieces" readonly="readonly" value="1" />
                            <button class="up-down plus">+</button>
                        </div>

                        <div class="cart-buttons">
                            <button class="js-cart to-cart" data-url="{{ route('cart.front.add', ['id' => $product->id]) }}">{{ trans('Stavi u korpu') }}</button>
                            <a href="{{ route('cart.front') }}"><button class="to-cart">Pogledaj korpu</button></a>
                        </div>
                    </form> 
                </div>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-duration="500" class="product-desc-title">Opis proizvoda</div>
        <div data-aos="fade-up" data-aos-duration="500" class="red-line mb-0 ml-0"></div>
        <div data-aos="fade-up" data-aos-duration="500" class="product-desc">
            {{ $product->description }}
        </div>

</section>

<x-similar-product :category="$product->category->id" :product="$product->id" />
@endsection