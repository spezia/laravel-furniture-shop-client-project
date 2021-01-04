<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{

    public function home()
    {
        return view('front.cart.show');
    }
}
