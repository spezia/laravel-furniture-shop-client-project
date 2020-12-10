<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     *  Must find by slug, because of translations cannot find object automatically
     *
     * @param string $slug
     * @param Product $service
     * 
     * @return Response
     */
    public function show(string $slug, Product $service)
    {
        if (!$model = $service->fetchBySlug($slug)) {
            abort(404);
        }

        // show front page about ...
        dd($model->name, $model->id);
    }
}
