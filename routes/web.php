<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GrowplanController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/register', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/register', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/login', [CustomerController::class, 'loginform'])->name('login');
Route::post('/login', [CustomerController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::resource('product', ProductController::class);

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::resource('artikel', ArtikelController::class);

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::resource('chat', ChatController::class);

Route::get('/growplan', [GrowplanController::class, 'index'])->name('growplan.index');
Route::post('/growplan', [GrowplanController::class, 'store'])->name('growplan.store');

Route::resource('growplan', GrowplanController::class);

Route::get('/video', [VideoController::class, 'index'])->name('video.index');
Route::resource('video', VideoController::class);

Route::get('/review', [ReviewController::class, 'index'])->name('reviews.index');
Route::resource('review', ReviewController::class);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::post('logout', [CustomerController::class, 'logout'])->name('logout');
