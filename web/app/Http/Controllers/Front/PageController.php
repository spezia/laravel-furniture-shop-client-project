<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PageController extends Controller
{
    /**
     * Display a Home page.
     *
     * @return Response
     */
    public function home()
    {
        return view('front.pages.home');
    }
}
