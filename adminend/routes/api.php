<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/register', [\App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/user/login', [\App\Http\Controllers\Api\UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    
    Route::get('/product/view', [\App\Http\Controllers\Api\UserController::class, 'viewProduct']);
    
    Route::get('/logout', function(){
        Auth::logout();
        return response()->json([
            'status'    => 'success',
            'message'   => 'Logout success full',
        ]);
    });
});
