@if($products->count() > 0)
<section>
    <h1 data-aos="fade-up" data-aos-duration="500">Naše reference</h1>
    <div data-aos="fade-up" data-aos-duration="500" class="red-line"></div>

    <div class="container-small">
        <div id="action-carousel" data-aos="fade-up" data-aos-duration="500" class="carousel slide carouse-top-arrows"
            data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="new-product-holder">
                    @foreach ($products as $product)
                        <div class="action-product d-none d-sm-block">
                            <div class="action-top">
                            <img src="{{ $product->single_image }}" alt="{{ $product->name }}" />
                                <div class="new-product-hover">
                                    <div>
                                        <button class="white-btn">{{ trans('Stavi u korpu') }}</button><br />
                                    <a href="{{ route('products.front.show', ['slug' => $product->slug]) }}"><button class="white-btn">{{ trans('Pogledaj') }}</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="new-product-bottom">
                                <div>
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="old-new-price">
                                        <p class="mb-0">
                                            {{ $product->discounts->count() > 0?
                                                floatval($product->discounts->first()->new_price) .' '. \config('custom.currency')
                                                 : floatval($product->price) .' '. \config('custom.currency') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration % 2 === 0 && !$loop->last)
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="new-product-holder">
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#action-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#action-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
@endif