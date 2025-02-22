<header>
    <div class="top-header">
        <div class="container-big">
        <div class="space-between">
            <div>Mail: info@konstantinhome.com |<br class="d-sm-none" /> Tel: +381 0000001</div>
            <div>
            <a href="#"><img src="{{ asset('img/header-footer/instagram.png') }}" alt="instagram" /></a>
            <a href="#"><img src="{{ asset('img/header-footer/fb.png') }}" alt="facebook" /></a>
            </div>
        </div>
        </div>
    </div>

    <div class="container-big">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="{{ route('pages.front.home') }}">
                <img src="{{ asset('img/header-footer/logo.png') }}" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <x-menu/>

            <div class="nar-right ml-auto">
                <x-shopingcart/>
                <x-langswitcher/>
            </div>
        </nav>
    </div>

</header>
