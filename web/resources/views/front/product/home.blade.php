@extends('layouts.app')

@section('title', __('Products'))

@section('content')

<!-- Main content -->
<section class="background-image products-bcg">
    <div class="container-small">
        <div>
            <h1 class="text-left">Proizvodi</h1>
            <div class="red-line mb-0"></div>
        </div>
    </div>
</section>

<section>
    @if ($category)
        <div class="container-small">

            <div data-aos="fade-up" data-aos-duration="500" class="filter-holder">
                <select id="order-by" class="filter-select">
                    <option value="" selected disabled hidden>Sortiraj po</option>
                    @foreach($sort as $value => $option)
                        <option value="{{ $value }}" {{ $value == $selectedSort? 'selected':'' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div class="product-categories-holder">

                <div class="categories">
                    <div data-aos="fade-up" data-aos-duration="500" class="category-big-txt">
                        Kategorije
                    </div>
                    <div data-aos="fade-up" data-aos-duration="500" class="red-line"></div>

                    <ul data-aos="fade-up" data-aos-duration="500">
                        @foreach($categories as $item) 
                            <li class="{{ $category && $item->slug == $category->slug? 'active' : '' }}">
                            <a href="{{ route('categories.front.show', ['slug' => $item->slug]) }}">
                                    <span>{{ $item->name }}</span>
                                    <span>({{ $item->products_count }})</span>
                                </a>
                            </li>
                        @endforeach    
                    </ul>
                </div>
                @if(count($products) > 0)
                <div class="products">
                    <div class="clearfix p-0">
                        @foreach($products as $product)
                            <div data-aos="fade-up" data-aos-duration="500" class="new-product">
                                <div class="new-product-top">
                                    @if($product->discounts->count() > 0)
                                        <div class="discount-tag tag-on-products">{{ $product->discounts->first()->discount }}</div>
                                    @endif
                                    <img src="{{ $product->single_image }}" alt="{{ $product->name }}" />

                                    <div class="new-product-hover">
                                        <div>
                                            <button class="white-btn">Stavi u korpu</button>
                                            <a href="{{ route('products.front.show', ['slug' => $product->slug]) }}"><button class="white-btn">Pogledaj</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="new-product-bottom">
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-price">
                                        {{ floatval($product->new_price) .' '. \config('custom.currency') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            {{ $products->links() }}
        </div>
    @else 
        <div class="container-small">
            <div>
                <h1 class="text-left">{{ __('No categories') }}</h1>
            </div>
        </div>
    @endif
</section>
@endsection

@section('javascript')
@parent
<script>
    $(document).ready(function () {
        $('#order-by').on('change', function(e){
            e.preventDefault();
            let value = $(this).val();
            location.href = '{{ url()->current() }}?order=' + value;
        });
    });
</script>
@endsection
