<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\OptController;
use App\Http\Controllers\ShipperController;

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
        Route::post('/tracking/import', [TrackingController::class, 'import'])->name('import tracking');
        Route::post('/tracking/update', [TrackingController::class, 'update'])->name('update order');
        Route::post('/tracking/delete', [TrackingController::class, 'delete'])->name('delete tracking');
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
    });


    Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
    Route::post('/profile-update', [AccountController::class, 'profileUpdate']);
    Route::post('/change-password', [AccountController::class, 'changePassword'])->name('change password');
});
Route::get('/verify_mobile', [OptController::class, 'verifyMobile']);
Route::get('/forget_password', [OptController::class, 'forgetPassword']);
Route::get('/reset_password', [OptController::class, 'resetPassword']);
require __DIR__ . '/auth.php';
