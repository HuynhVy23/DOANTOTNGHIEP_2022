<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
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
Route::prefix('/')->middleware(['auth','checkuser'])->group(function (){
Route::post('updateuser', [UserController::class, 'updateuser'])->name('updateuser');
Route::post('handleupdateuser', [UserController::class, 'handleupdateuser'])->name('handleupdateuser');
Route::get('changepass', [UserController::class, 'showchangePass'])->name('changepass');
Route::post('changepass', [UserController::class, 'changePass'])->name('changepassform');
Route::get('cart', [CartController::class,'showcart'])->name('cart');
Route::resource('cart', CartController::class)->only('store');
Route::resource('invoice', InvoiceController::class)->only(['show','store','index']);
Route::get('cart/{id}', [CartController::class, 'delete'])->name('cartdelete');
Route::get('cancel/{id}', [InvoiceController::class, 'cancel'])->name('invoicecancel');
}); 

Route::prefix('/')->middleware('checkadmin2')->group(function (){
    Route::get('/product', [ProductController::class, 'product'])->name('product');
    Route::get('/', [ProductController::class, 'indexUser'])->name('index');
    Route::get('/productdetail/{id}', [ProductDetailController::class, 'show'])->name('productdetail');
    Route::get('/brands', [BrandController::class, 'brand'])->name('brand');
    Route::get('/branddetail/{id}', [BrandController::class, 'showbrand'])->name('branddetail');
    Route::get('/scent/{id}', [ScentController::class, 'showscent'])->name('scent');        
});

Route::resource('account', UserController::class)->only(['create', 'store']);
Route::get('logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/login', [UserController::class, 'formlogin'])->name('login')->middleware('checkuser');
Route::post('/handlelogin', [UserController::class, 'handlelogin'])->name('handlelogin');

Route::get('/term', function () {
    return view('term');
})->name('term');

Route::get('/testimonial', function () {
    return view('testimonial');
})->name('testimonial');

Route::prefix('admin')->middleware('checkadmin')->group(function (){
    Route::get('/', function () {
        return view('index_admin');
    })->name('indexAdmin');
    Route::resource('account', UserController::class)->except(['create', 'store']);
    Route::resource('brand', BrandController::class)->except('show');
    Route::resource('productad', ProductController::class)->except('show');
    Route::resource('scentad', ScentController::class)->except('show');
    Route::resource('product_detail', ProductDetailController::class);
});