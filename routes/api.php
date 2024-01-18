<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\EnlaceController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function(){
    Route::post('/register',[AuthController::class,'register']);
    Route::get('/user',[AuthController::class,'index']);
    Route::get('/roles',[RoleController::class,'index']);
    Route::get('/bitacora',[BitacoraController::class,'index']);
    Route::get('/enlace',[EnlaceController::class,'index']);
    Route::post('/login',[AuthController::class,'login']);
});

// Router::post
