<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's

    Route::prefix('category')->group(function () {
        Route::post("create", [CategoryController::class,'create']);
        Route::get("view", [CategoryController::class,'view']);
        Route::put("edit", [CategoryController::class,'edit']);
        Route::delete("delete/{category_id}", [CategoryController::class,'delete']);
        
    });

    Route::prefix('product')->group(function () {
        Route::post("create", [ProductController::class,'create']);
        Route::get("view", [ProductController::class,'view']);
        Route::put("edit", [ProductController::class,'edit']);
        Route::delete("delete/{product_id}", [ProductController::class,'delete']);
        //Seed Products to db
        Route::get('/seed', function () {
            $seeder = Artisan::queue('db:seed');

            if($seeder){
                return response("Products Added to Database", 201);
            }else{
                return response("Products not Added to Database");
            }
        });
        Route::get('export', [ProductController::class,'download']);
    });

    Route::get("logout", [AuthController::class,'logout']);
    
});

Route::post("signup", [AuthController::class,'signup']);
Route::post("signin", [AuthController::class,'signin']);
