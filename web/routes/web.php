<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\PageController as FrontPageController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Front\ReviewController;

/*
 |--------------------------------------------------------------------------
 |  ADMIN PART
 |--------------------------------------------------------------------------
 */

Route::middleware(['auth', 'web'])->namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Pages
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::get('/pages/{page}  ', [PageController::class, 'show'])->name('pages.show');
    Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
    Route::match(['put', 'patch'], '/pages/{page}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{page}/destroy', [PageController::class, 'destroy'])->name('pages.destroy');

    // Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{category}  ', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::match(['put', 'patch'], '/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Product
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}  ', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::match(['put', 'patch'], '/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/products/{product}/image/{image}', [ProductController::class, 'destroyImage'])->name('products.remove.image');

    // Discount
    Route::get('/product-discounts', [ProductDiscountController::class, 'index'])->name('product-discounts.index');
    Route::get('/product-discounts/create', [ProductDiscountController::class, 'create'])->name('product-discounts.create');
    Route::get('/product-discounts/{productDiscount}  ', [ProductDiscountController::class, 'show'])->name('product-discounts.show');
    Route::get('/product-discounts/{productDiscount}/edit', [ProductDiscountController::class, 'edit'])->name('product-discounts.edit');
    Route::post('/product-discounts', [ProductDiscountController::class, 'store'])->name('product-discounts.store');
    Route::match(['put', 'patch'], '/product-discounts/{productDiscount}', [ProductDiscountController::class, 'update'])->name('product-discounts.update');
    Route::delete('/product-discounts/{productDiscount}/destroy', [ProductDiscountController::class, 'destroy'])->name('product-discounts.destroy');

    // Reviews
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}  ', [AdminReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{review}/edit', [AdminReviewController::class, 'edit'])->name('reviews.edit');
    Route::match(['put', 'patch'], '/reviews/{review}', [AdminReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
});

/**
 |--------------------------------------------------------------------------
 |  FRONT PART
 |--------------------------------------------------------------------------
 | @link https://laraveldaily.com/multi-language-routes-and-locales-with-auth/
 */
// for same reason we session does not work and we must set locale here again because
// of translating route params like 'about', 'contact'...
app()->setLocale(request()->segment(1, config('app.locale')));
Route::group(['middleware' => ['web']], function () {

    // to redirect the user from non-localed homepage to /en/ homepage
    Route::get('/', function () {
        return redirect(app()->getLocale());
    });

    // keep only login/logout
    Auth::routes([
        'register' => false,
        'reset' => false,
        'confirm' => false,
        'verify' => false,
    ]);
    // lang switcher 
    Route::get('set-locale/{lang}', function ($lang) {
        app()->setLocale($lang);

        return redirect()->route('pages.front.home', $lang);
    })->name('locale.setting');

    // Contact
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
    // Review
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

    Route::group([
        'prefix' => '{locale}',
        'where' => ['locale' => '[a-zA-Z]{2}'],
        'middleware' => ['setlocale', 'web']
    ], function () {

        // Pages
        Route::get('/', [FrontPageController::class, 'home'])->name('pages.front.home');

        // show directly templates
        Route::view(trans('routes.about'), 'front.pages.about')->name('page.about');
        Route::view(trans('routes.impressions'), 'front.pages.impressions')->name('page.impressions');
        Route::view(trans('routes.contact'), 'front.pages.contact')->name('page.contact');

        // Products
        Route::get('/' . trans('routes.products'), [FrontProductController::class, 'home'])->name('products.front.home');
        Route::get('/' . trans('routes.products') . '/{slug}', [FrontProductController::class, 'show'])->name('products.front.show');

        // Categories
        Route::get('/' . trans('routes.categories') . '/{slug}', [FrontProductController::class, 'home'])->name('categories.front.show');
    });
});
