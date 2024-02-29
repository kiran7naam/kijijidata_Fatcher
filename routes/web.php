<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('login');
});
Route::group(['middleware' => 'guest'],function(){
    Route::get('/login',[AuthController::class, 'login'])->name('login');
    Route::post('/login',[AuthController::class, 'loginUser'])->name('login');
});

Route::group(['middleware' => 'auth'],function(){
    Route::get('/home',[HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/product-fetch',[ProductController::class,'product_fetch'])->name('product-fetch');
    Route::get('/view-products',[ProductController::class,'index'])->name('view_products');
    Route::post('/get_product_details',[ProductController::class,'get_product_details']);
    Route::post('/delete_product',[ProductController::class,'delete_product']);
    Route::get('update_is_like/{id}',[ProductController::class,'update_is_like'])->name('update_is_like');
    Route::get('/deleted-products',[ProductController::class,'deleted_products'])->name('deleted-products');
    Route::get('/contacted-products',[ProductController::class,'contacted_products'])->name('contacted_products');
    Route::post('/restore_product',[ProductController::class,'restore_product']);
    Route::post('/permanent_delete_product',[ProductController::class,'permanent_delete_product']);
    Route::post('/is_contacted',[ProductController::class,'is_contacted']);

    Route::get('/user-profile/{id}',[AuthController::class, 'user_profile'])->name('user-profile');
    Route::post('/update_profile/{id}',[AuthController::class, 'edit_user'])->name('update_profile');
    Route::get('/view-users',[AuthController::class,'view_users'])->name('view-users');
    Route::post('/delete_user',[AuthController::class,'delete_user']);
    
    Route::get('/register',[AuthController::class, 'register'])->name('register');
    Route::post('/register',[AuthController::class, 'registerUser'])->name('register');
});



