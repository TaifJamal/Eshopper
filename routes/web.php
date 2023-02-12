<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\AdminControler;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin')->name('admin.')->middleware('auth','checkAdmin')->group(function(){
    Route::get('/',[AdminControler::class,'index']);

    //sliders
    Route::get('sliders/trach',[SliderController::class,'trach'])->name('sliders.trash');
    Route::get('sliders/{id}/restore',[SliderController::class,'restore'])->name('sliders.restore');
    Route::delete('sliders/{id}/forcedelete',[SliderController::class,'forcedelete'])->name('sliders.forcedelete');
    Route::resource('sliders',SliderController::class);

    //categories
    Route::get('categories/trach',[CategoryController::class,'trach'])->name('categories.trash');
    Route::get('categories/{id}/restore',[CategoryController::class,'restore'])->name('categories.restore');
    Route::delete('categories/{id}/forcedelete',[CategoryController::class,'forcedelete'])->name('categories.forcedelete');
    Route::resource('categories',CategoryController::class);

    //products
    Route::get('products/trach',[ProductController::class,'trach'])->name('products.trash');
    Route::get('products/{id}/restore',[ProductController::class,'restore'])->name('products.restore');
    Route::delete('products/{id}/forcedelete',[ProductController::class,'forcedelete'])->name('products.forcedelete');
    Route::resource('products',ProductController::class);


    //clients
    Route::resource('clients',ClientController::class);
});

    Route::get('/',[SiteController::class,'index'])->name('site.index');
    Route::get('/category/{id}',[SiteController::class,'category'])->name('site.category');
    Route::get('/cart',[SiteController::class,'cart'])->name('site.cart');
    Route::post('/add-to-cart',[SiteController::class,'add_to_cart'])->name('site.add_to_cart');
    Route::delete('/remove-from-cart/{id}',[SiteController::class,'remove_from_cart'])->name('site.remove_from_cart');
    Route::get('/checkout',[SiteController::class,'checkout'])->name('site.checkout');
    Route::get('/contact',[SiteController::class,'contact'])->name('site.contact');
    Route::post('/contact',[SiteController::class,'contact_data'])->name('site.contact_data');
    Route::get('/detail/{id}',[SiteController::class,'detail'])->name('site.detail');
    Route::get('/shop',[SiteController::class,'shop'])->name('site.shop');
    Route::post('/add-review',[SiteController::class,'add_review'])->name('site.add_review');
    Route::get('/search',[SiteController::class,'search'])->name('site.search');


    Route::view('not-allowed', 'not_allowed');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
