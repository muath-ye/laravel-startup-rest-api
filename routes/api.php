<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Api\ProductController;

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

Route::post(
    'register', 'Api\RegisterController@register'
);

Route::post(
    'signup', 'Api\RegisterController@register'
);

Route::post(
    'login', 'Api\RegisterController@login'
);

Route::middleware('auth:api')->group(
    function () {
        Route::resource('products', ProductController::class);
    }
);