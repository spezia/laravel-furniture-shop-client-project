<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Services\Page as PageService;

class PageController extends Controller
{
    /**
     * Display a Home page.
     *
     * @return Response
     */
    public function home()
    {
        $locale = 'en';
        return view('front.pages.home', [
            'locale' => $locale,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     *
     * @return Response
     */
    public function show(string $slug = null, PageService $pageService)
    {
        if (!$page = $pageService->fetchBySlug($slug)) {
            abort(404);
        }

        return view('front.pages.view', [
            'page' => $page,
            'locale' => app()->getLocale(),
        ]);
    }
}
