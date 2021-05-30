<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect(url('/user/login'));
});

Route::get('/user/login', function(){
    return view('login');
})->name('user.login');

Route::get('/user/register', function(){
    return view('register');
})->name('user.register');

Route::post('/newuser/register', [App\Http\Controllers\LoginController::class, 'Register'])->name('newuser.register');
Route::post('/user/login', [App\Http\Controllers\LoginController::class, 'Login'])->name('user.validation');


Route::group(['middleware' => ['adminAuth']], function () {
    Route::view('/dashboard', 'dashboard');
    Route::get('/create/product', [App\Http\Controllers\ProductController::class, 'create'])->name('create.product');
    Route::post('/store/product', [\App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    Route::get('/view/product', [App\Http\Controllers\ProductController::class, 'index'])->name('index.product');
    Route::get('/view/product/details/{id}', [\App\Http\Controllers\ProductController::class, 'view'])->name('product.view');
    Route::post('/product/delete', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');

    Route::get('/logout', function(){
        Auth::guard('web')->logout();

        return redirect()->route('user.login');
    })->name('logout');
});

