<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\OptController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;

// Route::get('/', [AuthenticatedSessionController ::class, 'create'])->name('front page');
Route::get('/', [TrackController::class, 'index'])->name('front page');
Route::post('/', [TrackController::class, 'getData']);
// Route::get('tes', [TrackController::class, 'getData']);
Route::get('/token', function () {
    return csrf_token();
});

Route::group(['middleware' => ['auth']], function () {

    Route::middleware(['member'])->group(function () {

        Route::get('/seller', function () {
            return redirect(route('dashboard'));
        });
        Route::get('/dashboard', [SellerController::class, 'dashboard'])->name('dashboard');
        Route::get('/chart-data', [SellerController::class, 'chartData']);
        Route::get('/seller/manage-tracking', [TrackingController::class, 'index'])->name('manage tracking');
        Route::get('/tracking/data', [TrackingController::class, 'data'])->name('data tracking');
        Route::post('/tracking/insert', [TrackingController::class, 'store'])->name('insert tracking');
        Route::post('/tracking/import', [TrackingController::class, 'import_new'])->name('import_tracking');
        Route::post('/tracking/update', [TrackingController::class, 'update'])->name('update order');
        Route::post('/tracking/delete', [TrackingController::class, 'delete'])->name('delete tracking');
        Route::get('/track-page', [TrackingController::class, 'trackPage'])->name('track page');
        //Tracking
        Route::post('/track-id', [SellerController::class, 'TrackId'])->name('Track Id');
        //product
        Route::get('/product', [ProductController::class, 'product'])->name('product');
        Route::get('/product/data', [ProductController::class, 'data'])->name('data product');
        Route::post('/product/insert', [ProductController::class, 'insert'])->name('insert product');
        Route::post('/product/update', [ProductController::class, 'update'])->name('update product');
        Route::post('/product/delete', [ProductController::class, 'delete'])->name('delete product');

        //payment
        Route::get('/payment/{id}', [PaymentController::class, 'payment'])->name('payment');
        Route::post('/payment/package', [PaymentController::class, 'packagePayment'])->name('package payment');
        Route::get('/payment-success', [PaymentController::class, 'paymentSccuess'])->name('payment success');
       
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin dashboard');
        Route::get('manage-seller', [AdminController::class, 'manageSeller'])->name('manage seller');
        Route::get('seller/data', [AdminController::class, 'data'])->name('data seller');
        Route::post('seller/insert', [AdminController::class, 'insert'])->name('insert seller');
        Route::post('seller/update', [AdminController::class, 'update'])->name('update seller');
        Route::post('seller/delete', [AdminController::class, 'delete'])->name('delete seller');
        Route::get('manage-shipper', [ShipperController::class, 'index'])->name('manage shipper');
        Route::get('shipper/data', [ShipperController::class, 'data'])->name('data shipper');
        Route::post('shipper/insert', [ShipperController::class, 'insert'])->name('insert shipper');
        Route::post('shipper/update', [ShipperController::class, 'update'])->name('update shipper');
        Route::post('shipper/delete', [ShipperController::class, 'delete'])->name('delete shipper');
        Route::get('/user-logo', [AdminController::class, 'userLogo'])->name('user logo');
        Route::post('/user-logo-update', [AdminController::class, 'uploadUserLogo'])->name('upload user logo');
         //package
         Route::get('/package', [SellerController::class, 'package'])->name('package');
         Route::get('/package/data', [SellerController::class, 'data'])->name('data package');
         Route::post('/package/insert', [SellerController::class, 'insert'])->name('insert package');
         Route::post('/package/update', [SellerController::class, 'update'])->name('update package');
         Route::post('/package/delete', [SellerController::class, 'delete'])->name('delete package');
         //trackinglog
         Route::get('seller/tracking-log/{id}', [AdminController::class, 'trackingLog'])->name('seller tracking log');
    
    });

     Route::get('/your_packages', [AccountController::class, 'yourPackages'])->name('your_packages');
    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::post('/profile-update', [AccountController::class, 'profileUpdate']);
    Route::post('/change-password', [AccountController::class, 'changePassword'])->name('change password');
});
Route::get('verify_mobile', [OptController::class, 'verifyMobile'])->name('verify_mobile');
Route::post('/get-otp', [OptController::class, 'getOtp'])->name('get-otp');
Route::post('/reset-pass', [OptController::class, 'resetpass'])->name('reset-pass');
Route::post('/get-phone', [OptController::class, 'getPhone'])->name('get-phone');
Route::get('/forget_password', [OptController::class, 'forgetPassword']);
Route::get('/reset_password', [OptController::class, 'resetPassword']);
//customer
Route::get('/track-id-list', [CustomerController::class, 'TrackingDetails']);
Route::post('/track-id-req', [CustomerController::class, 'trackIdReq'])->name('track id req');

require __DIR__ . '/auth.php';
