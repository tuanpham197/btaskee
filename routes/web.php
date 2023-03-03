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