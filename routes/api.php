<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\controllers\controller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test', function () {
    return ["name"=>"John Doe", "email"=>"john@example.com"];
});

Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::get('students', [StudentController::class, 'index']);
});

// Route::get('students', [StudentController::class, 'index']);

Route::post('signup', [UserAuthController::class, 'signup']);

Route::post('login', [UserAuthController::class, 'login']);



Route::get('login', [UserAuthController::class, 'login'])->name('login');