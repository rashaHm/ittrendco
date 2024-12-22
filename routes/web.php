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
    return view('welcome');
});
use App\Events\OrderCustomer;
use App\Events\CustomerOrder;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            
use App\Http\Controllers\CategoryController;            
use App\Http\Controllers\ProductController;     
use App\Http\Controllers\CartController;            
use App\Http\Controllers\PaymentController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\OrderController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('auth');
Route::get('/add-category', [CategoryController::class, 'create'])->name('add_category')->middleware('auth');
Route::post('/add-category', [CategoryController::class, 'store'])->name('store_category')->middleware('auth');
Route::get('/orders', [OrderController::class, 'index'])->name('orders')->middleware('auth');
Route::post('/update-order/{order_id}', [OrderController::class, 'update_order'])->name('update_order')->middleware('auth');
Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('/add-user', [UserController::class, 'create'])->name('add_user')->middleware('auth');
Route::post('/add-user', [UserController::class, 'store'])->name('store_user')->middleware('auth');

	//////////////////////
Route::get('/my', function(){
		broadcast();
		\App\Events\OrderCustomer::dispatch(["a"=>"hello"]);
	//	event(new CustomerOrder('xxx'));
		return 23;
		
	});
	////////////////////
Route::get('/products', [ProductController::class, 'index'])->name('products')->middleware('auth');
Route::get('/add-product', [ProductController::class, 'create'])->name('add_product')->middleware('auth');
Route::post('/store-product', [ProductController::class, 'store'])->name('store_product')->middleware('auth');
Route::get('/add-to-cart/{product_id}', [CartController::class, 'add_to_cart'])->name('add_to_cart')->middleware('auth');
Route::get('/cart', [CartController::class, 'cart'])->name('cart')->middleware('auth');
Route::get('/remove-from-cart/{product_id}', [CartController::class, 'remove_from_cart'])->name('remove_from_cart')->middleware('auth');
Route::get('/purchase', [CartController::class, 'purchase'])->name('purchase')->middleware('auth');
Route::post('/place-order',[PaymentController::class,'place_order'])->name('place_order')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

	
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

