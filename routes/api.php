<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'prefix'=>'auth'
],function(){
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);

});



Route::group([
    'middleware' => ['apiJwt']
], function(){

       // ROTAS DE CLIENT CONTROLLERS
       Route::apiResource('clients',ClientController::class);
       Route::apiResource('categories',CategoryController::class);
       Route::apiResource('providers',ProviderController::class);
       Route::apiResource('invoices',InvoiceController::class);
       Route::apiResource('products',ProductController::class);


       Route::post('logout',[AuthController::class,'logout']);
       Route::get('refresh',[AuthController::class,'refresh']);
       Route::get('me',[AuthController::class,'me']);
});


