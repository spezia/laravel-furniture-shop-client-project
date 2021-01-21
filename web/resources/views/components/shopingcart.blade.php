<a href="{{ route('cart.front') }}" class="shoping-cart">
    <img src="{{ asset('img/header-footer/cart.png') }}" alt="shopping cart" />
    <label id="js-shopping-total">{{ session()->has('cart') ? count(session('cart')) : 0}}</label>
</a>