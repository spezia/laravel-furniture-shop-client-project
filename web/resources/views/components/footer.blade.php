<footer>
    <div class="container-big">
        <div class="space-between">
        <img class="footer-logo" src="{{ asset('img/header-footer/logo-footer.png') }}" alt="footer logo" />

        <ul>
            <li><a href="{{ route('page.about') }}">{{ __('custom.aboutus') }}</a></li>
            <li><a href="{{ route('products.front.home') }}">{{ __('custom.products') }}</a></li>
            <li><a href="{{ route('page.contact') }}">{{ __('custom.contact') }}</a></li>
        </ul>

        <div class="scroll-btn"><img src="{{ asset('img/home/arrow-black.png') }}" alt="" /></div>

        </div>
    </div>

    <div class="copyright">© <?php echo date('Y') ?> Konstantin home</div>
</footer>