<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout']);
Route::post('register', [UserController::class, 'register']);

//
Route::group([
    'middleware' => 'auth'
], function() {
    Route::get('address/province', [AddressController::class, 'getProvinces'])->name('ajax.provinces');;
    Route::get('address/district/{provinceId}', [AddressController::class, 'getDistricts'])->name('ajax.districts');;
    Route::get('address/ward/{districtId}', [AddressController::class, 'getWards'])->name('ajax.wards');
    Route::get('services-detail/{serviceId}', [ServiceController::class, 'ajaxDetailList'])->name('ajax.services');

    // booking router
    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    Route::get('/booking/{bookingId}', [BookingController::class, 'detail'])->name('detail-booking');
    Route::post('/booking', [BookingController::class, 'booking']);
    Route::post('/payment', [BookingController::class, 'payment']);

    Route::post('checkout', [CheckoutController::class, 'checkout']);
    Route::get('checkout-success', [CheckoutController::class, 'checkoutSuccess']);
    Route::get('checkout-ipn', [CheckoutController::class, 'checkoutIPN']);

    Route::get('/shifts', [BookingController::class, 'shifts'])->name('shifts');
    Route::get('/shift-range', [BookingController::class, 'generateRangeTimeAjax']);
    Route::get('payment', function() {
        return view('customers.payment');
    });

});

Route::get('test', [CheckoutController::class, 'test']);
Route::get('services/{id}', [ServiceController::class, 'detail']);








Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('customers.about');
});


Route::get('/info', function () {
    return view('customers.info');
});
Route::get('/contact', function () {
    return view('customers.contact');
});

Route::get('/service-one', function () {
    return view('customers.service_one');
});

Route::get('/service-two', function () {
    return view('customers.service_two');
});



Route::get('/reward', function () {
    return view('customers.reward');
});


