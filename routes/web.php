<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorefrontController;

Route::get('/', [StorefrontController::class, 'home'])->name('home');
Route::get('/products', [StorefrontController::class, 'products'])->name('products.index');
Route::get('/products/{slug}', [StorefrontController::class, 'product'])->name('products.show');
Route::get('/categories/{slug}', [StorefrontController::class, 'category'])->name('categories.show');

Route::get('/cart', [StorefrontController::class, 'cart'])->name('cart.index');
Route::post('/cart/add/{id}', [StorefrontController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart/{id}', [StorefrontController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/{id}', [StorefrontController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/checkout', [StorefrontController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [StorefrontController::class, 'placeOrder'])->name('checkout.place');

Route::view('/contact', 'store.static', [
    'pageTitle' => 'Contact',
    'pageText' => 'Contact information'
])->name('contact');

Route::view('/about', 'store.static', [
    'pageTitle' => 'About us',
    'pageText' => 'About MobixHub'
])->name('about');

Route::view('/terms', 'store.static', [
    'pageTitle' => 'Terms',
    'pageText' => 'Store terms and conditions'
])->name('terms');
