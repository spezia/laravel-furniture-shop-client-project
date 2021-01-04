<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mx-auto">
        <li class="nav-item @if(\Request::route()->getName() == 'pages.front.home') active @endif">
            <a class="nav-link" href="{{ route('pages.front.home') }}">{{ __('custom.home') }}</a>
            <div class="active-line"></div>
        </li>
        <li class="nav-item  @if(\Request::route()->getName() == 'page.about') active @endif">
            <a class="nav-link" href="{{ route('page.about') }}">{{ __('custom.aboutus') }}</a>
        </li>
        <li class="nav-item has-dropdown 
            @if(in_array(\Request::route()->getName(), ['products.front.home', 'products.front.show', 'categories.front.show'])) active @endif
        ">
            <a class="nav-link" href="{{ route('products.front.home') }}">{{ __('custom.products') }}</a>
            <x-categories/>
        </li>
        <li
            class="nav-item @if(\Request::route()->getName() == 'page.impressions') active @endif">
            <a class="nav-link" href="{{ route('page.impressions') }}">{{ __('custom.impressions') }}</a>
        </li>
        <li class="nav-item @if(\Request::route()->getName() == 'page.contact') active @endif">
            <a class="nav-link" href="{{ route('page.contact') }}">{{ __('custom.contact') }}</a>
        </li>
    </ul>
</div>