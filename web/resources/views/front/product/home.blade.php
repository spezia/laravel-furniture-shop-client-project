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
                <select class="filter-select">
                    <option value="" selected disabled hidden>Sortiraj po</option>
                    <option value="price-up">Ceni rastuce</option>
                    <option value="price-down">Ceni opadajuce</option>
                    <option value="name-up">Imenu rastuce</option>
                    <option value="name-down">Imenu opadajuce</option>
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
                                    {{ $product->discounts->count() > 0?
                                         $product->discounts->first()->new_price .' '. \config('custom.currency')
                                         : $product->price .' '. \config('custom.currency') }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div data-aos="fade-up" data-aos-duration="500" class="new-product">
                            <div class="new-product-top">
                                <div class="discount-tag tag-on-products">-20%</div>
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
                            <div class="new-product-top">
                                <div class="discount-tag tag-on-products">-20%</div>
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
                            <div class="new-product-top">
                                <div class="discount-tag tag-on-products">-20%</div>
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
                            <div class="new-product-top">
                                <div class="discount-tag tag-on-products">-20%</div>
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
                        <div data-aos="fade-up" data-aos-duration="500" class="new-product">
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
                        </div>  --}}
                    </div>
                    @endif
                </div>
            </div>

            {{ $products->links() }}
            <nav data-aos="fade-up" data-aos-duration="500">
                <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#"><img src="assets/dist/img/home/arrow-black.png" alt="arrow" /></a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><a class="page-link" href="#">6</a></li>
                <li class="page-item"><a class="page-link" href="#"><img src="assets/dist/img/home/arrow-black.png" alt="arrow" /></a></li>
                </ul>
            </nav>

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
