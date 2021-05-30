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
    return redirect()->route('login');
});

Route::get('/login', function(){
    return view('login');
})->name('login');

Route::get('/user/register', function(){
    return view('register');
})->name('user.register');

Route::post('/user/register', [\App\Http\Controllers\LoginController::class, 'register'])->name('user.register');
Route::post('/user/login', [App\Http\Controllers\LoginController::class, 'login'])->name('user.login');

Route::group(['middleware' => ['userAuth']], function(){
    Route::get('/dashboard', [App\Http\Controllers\LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
});
