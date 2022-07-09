<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ScentController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;

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
Route::resource('review', ReviewController::class)->only(['show','store']);
}); 

Route::prefix('/')->middleware('checkadmin2')->group(function (){
    Route::get('/product', [ProductController::class, 'product'])->name('product');
    Route::get('/', [ProductController::class, 'indexUser'])->name('index');
    Route::get('/productdetail/{id}', [ProductDetailController::class, 'show'])->name('productdetail');
    Route::get('/brands', [BrandController::class, 'brand'])->name('brand');
    Route::get('/branddetail/{id}', [BrandController::class, 'showbrand'])->name('branddetail');
    Route::get('/scent/{id}', [ScentController::class, 'showscent'])->name('scent');
    Route::get('/gender/{id}', [ProductController::class, 'gender'])->name('gender');      
    Route::post('reset-password', [ResetPasswordController::class,'sendMail']);
    Route::put('reset-password/{token}', [ResetPasswordController::class,'sreset']);  
    Route::get('forgotpassword', [ResetPasswordController::class,'index'])->name('forgotpassword');
    Route::post('forgotHandler', [ResetPasswordController::class,'forgotHandler'])->name('forgotHandler');
    Route::get('resetpassword/{token}',[ResetPasswordController::class,'resetpassword'])->name('resetpassword');
    Route::post('resetHandler', [ResetPasswordController::class,'resetHandler'])->name('resetHandler');
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
    Route::get('/invoiceAdmin', [InvoiceController::class, 'invoiceAdmin'])->name('invoiceAdmin');
    Route::get('/invoiceAdmin/{id}', [InvoiceController::class, 'showInvoiceAdmin'])->name('showInvoiceAdmin');
    Route::get('/hoadonnhap',[ InvoiceController::class,'hoadonnhap'])->name('receipt');
    Route::get('/hoadonnhap/{id}',[ InvoiceController::class,'chitietnhap'])->name('showreceipt');
    Route::get('/hoadonnhapp/add',[InvoiceController::class,'themhdnhap'])->name('addreceipt');
    Route::post('/xuli',[InvoiceController::class,'xulihdnhap'])->name('add');
    Route::resource('/salead', SaleController::class)->except('show');
    Route::resource('/sale_detailad', SaleDetailController::class)->except('show');
});
// dhwcztyshoffkzdi