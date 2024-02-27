<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AccessoriesController;
use App\Http\Controllers\Voyager\ChartsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


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
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

    Route::get('/motor', [MotorController::class, 'index'])->name('motor.index');
    Route::get('/motor/{brand}', [MotorController::class, 'showByBrand']);
    Route::get('/motor/details/{id}', [MotorController::class, 'showDetails'])->name('motordetails');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart/success', function () {
        return view('success');
    })->name('cart.success');
    Route::get('/cart/cancel', function () {
        return view('cancel');
    })->name('cart.cancel');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{id}/remove', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('/accessories', [AccessoriesController::class, 'index'])->name('accessories.index');
    Route::get('/accessories/category/{category}', [AccessoriesController::class, 'showByCategory'])->name('accessories.category');
    Route::get('/accessories/{id}', [AccessoriesController::class, 'showDetails'])->name('accessories.details');
});




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


