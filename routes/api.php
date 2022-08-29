<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserControllerr;
use App\Http\Controllers\Api\UserNormal;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('register','App\Http\Controllers\Api\UserNormal@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');


Route::group(['middleware' => ['apiJwt']],function(){
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::apiResource('user',UserControllerr::class)->except('store','update') ;//->only('index','show');
    Route::apiResource('user.post',PostController::class);//->only('index','show');
});
