<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\LoginController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/',function(){
    return 'API is working';
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users',[LoginController::class,'getUsers'])->name('users.get');
    Route::get('/user/{id}',[LoginController::class,'getUser'])->name('user.get');
});

Route::post('/login',[LoginController::class,'getToken'])->name('login.post');

