<?php

use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\VerificationController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)
    ->group(function (){
       Route::get('', 'index')->name('home');
       Route::get('/locale/{locale}', 'language')->name('language')->where('locale', '[a-z]+');
    });

Route::controller(ProductController::class)
    ->group(function () {
        Route::get('/product/{code}', 'product')->name('product')->where('code', '[0-9-]+');
        Route::get('/category/{slug}', 'category')->name('category')->where('slug', '[A-Za-z0-9-]+');
    });

Route::controller(CartController::class)
    ->prefix('/cart')
    ->name('cart.')
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('/add/{id}', 'add')->name('add')->where('id', '[0-9]+');
        Route::get('/remove/{id}', 'remove')->name('remove')->where('id', '[0-9]+');
        Route::get('/clear', 'clear')->name('clear');
    });

Route::controller(VerificationController::class)
    ->middleware(['guest:customer_web', 'throttle:3,1'])
    ->group(function () {
        Route::get('/verification', 'create')->name('verification');
        Route::post('/verification', 'store');
    });

Route::controller(LoginController::class)
    ->middleware('guest:customer_web')
    ->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store');
    });

Route::controller(LoginController::class)
    ->middleware('auth:customer_web')
    ->group(function () {
        Route::post('/logout', 'destroy')->name('logout');
    });