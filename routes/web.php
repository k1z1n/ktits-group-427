<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('check.admin')->group(function () {
    Route::get('/create', [ProductController::class, 'showCreate'])->name('create');
    Route::post('/product/store', [ProductController::class, 'createProduct'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'showEdit'])->name('view.product.edit');
    Route::put('/product/{id}/update', [ProductController::class, 'updateProduct'])->name('product.update');
    Route::get('/product/{id}/delete', [ProductController::class, 'showDeleteProduct'])->name('view.product.delete');
    Route::delete('/product/{id}/destroy', [ProductController::class, 'deleteProduct'])->name('product.delete');
});

Route::middleware('check.guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLogin'])->name('view.login');
    Route::get('/register', [UserController::class, 'showRegister'])->name('view.register');
    Route::post('/register/store', [UserController::class, 'register'])->name('register');
    Route::post('/login/store', [UserController::class, 'login'])->name('login');
});

Route::middleware('check.auth')->group(function () {
    Route::get('/', [ProductController::class, 'showMain'])->name('main');
    Route::get('/product', [ProductController::class, 'showProduct'])->name('product');

    Route::get('/cart', [CartController::class, 'showCart'])->name('view.cart');
    Route::post('/cart/add/{productId}', [ProductController::class, 'addToCart'])->name('cart.add');

    Route::post('/cart/count/remove/{cartId}', [CartController::class, 'removeCount'])->name('cart.count.remove');
    Route::post('/cart/count/add/{cartId}', [CartController::class, 'addCount'])->name('cart.count.add');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/profile', [OrderController::class, 'showProfile'])->name('view.profile');
    Route::post('/create/order', [OrderController::class, 'createOrder'])->name('create.order');
});













