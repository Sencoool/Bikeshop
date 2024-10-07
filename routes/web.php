<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderingController;
use App\Http\Controllers\UserController;

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

Route::get('/home',[HomeController::class,'index'])->name('home');

// Product routes
Route::get('/product',[ProductController::class,'index']);
Route::post('/product/search', [ProductController::class, 'search']);
Route::get('/product/edit/{id?}', [ProductController::class, 'edit']); /*id? no need to insert value first*/
Route::post('/product/update', [ProductController::class, 'update']);
Route::post('/product/insert',[ProductController::class,'insert']);
Route::get('/product/remove/{id}',[ProductController::class,'remove']);

// Category routes
Route::get('/category',[CategoryController::class,'index']);
Route::post('/category/search',[CategoryController::class,'search']);
Route::get('/category/edit/{id?}', [CategoryController::class, 'edit']);
Route::post('/category/update',[CategoryController::class,'update']);
Route::post('/category/insert',[CategoryController::class,'insert']);
Route::get('/category/remove/{id}',[CategoryController::class,'remove']);

Route::get('/cart/view',[CartController::class,'viewCart']);
Route::get('/cart/add/{id}',[CartController::class,'addToCart']);
Route::get('/cart/delete/{id}',[CartController::class,'deleteCart']);
Route::get('/cart/update/{id}/{qty}',[CartController::class,'updateCart']);
Route::get('/cart/checkout',[CartController::class,'checkout']);
Route::get('/cart/complete',[CartController::class,'complete']);
Route::get('/cart/finish',[CartController::class,'finish_order']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/employee/order', [App\Http\Controllers\OrderingController::class, 'index']);
Route::get('/employee/detail/{id}', [App\Http\Controllers\OrderingController::class, 'viewDetail']);
Route::post('/employee/changeStatus', [OrderingController::class, 'changeStatus']);

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/search', [UserController::class, 'search']);
Route::post('/user/search', [UserController::class, 'search']);
Route::get('/user/edit/{id?}', [UserController::class, 'edit']);
Route::post('/user/update', [UserController::class, 'update']);
Route::get('/user/add', [UserController::class, 'add']);
Route::post('/user/insert', [UserController::class, 'insert']);
Route::get('/user/remove/{id}', [UserController::class, 'remove']);



