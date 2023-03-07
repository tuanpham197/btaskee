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
    return view('customers.home');
});

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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/reward', function () {
    return view('customers.reward');
});

Route::get('/booking', function () {
    return view('customers.booking');
});