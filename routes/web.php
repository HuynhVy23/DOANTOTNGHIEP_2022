<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ScentController;
use App\Http\Controllers\ProductDetailController;

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


Route::get('/product', [ProductController::class, 'product'])->name('product');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');



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

Route::get('/', [ProductController::class, 'indexUser'])->name('index');
Route::post('/login', [UserController::class, 'login']);
Route::get('/productdetail/{id}', [ProductDetailController::class, 'show'])->name('productdetail');
Route::get('/changepass', [UserController::class, 'showchangePass'])->name('changepass');
Route::post('/changepass', [UserController::class, 'changePass'])->name('changepassform');
Route::get('/brands', [BrandController::class, 'brand'])->name('brand');
Route::get('/branddetail/{id}', [BrandController::class, 'showbrand'])->name('branddetail');
Route::get('/scent/{id}', [ScentController::class, 'showscent'])->name('scent');

Route::resource('account', UserController::class);
Route::resource('brand', BrandController::class)->except('show');
Route::resource('productad', ProductController::class)->except('show');
Route::resource('scentad', ScentController::class)->except('show');
Route::resource('product_detail', ProductDetailController::class);
