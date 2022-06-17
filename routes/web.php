<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/productdetail', function () {
    return view('productdetail');
})->name('productdetail');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/blogdetail', function () {
    return view('blogdetail');
})->name('blogdetail');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/term', function () {
    return view('term');
})->name('term');

Route::get('/testimonial', function () {
    return view('testimonial');
})->name('testimonial');

Route::get('/admin', function () {
    return view('index_admin');
})->name('indexAdmin');

Route::resource('brand', BrandController::class)->except('show');
Route::resource('product', ProductController::class)->except('show');
Route::resource('scent', ScentController::class)->except('show');
Route::resource('product_detail', ProductDetailController::class)->except('show');