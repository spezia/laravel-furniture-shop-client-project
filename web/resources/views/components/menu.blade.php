{{-- @TODO: request should check translatable route param (about, products*, contact...) --}}
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mx-auto">
    <li class="nav-item @if(\Request::route()->getName() == 'pages.front.home') active @endif">
        <a class="nav-link" href="{{ route('pages.front.home') }}">{{ __('custom.home') }}</a>
        <div class="active-line"></div>
    </li>
    <li class="nav-item  @if(\Request::is('about')) active @endif">
        <a class="nav-link" href="{{ route('page.about') }}">{{ __('custom.aboutus') }}</a>
    </li>
    <li class="nav-item has-dropdown @if(\Request::is('products*')) active @endif">
        <a class="nav-link" href="{{ route('products.front.home') }}">{{ __('custom.products') }}</a>
        <x-categories/>
    </li>
    <li
        class="nav-item @if(\Request::is('impressions')) active @endif">
        <a class="nav-link" href="{{ route('page.impressions') }}">{{ __('custom.impressions') }}</a>
    </li>
    <li class="nav-item @if(\Request::is('contact')) active @endif">
        <a class="nav-link" href="{{ route('page.contact') }}">{{ __('custom.contact') }}</a>
    </li>

    </ul>
</div>