<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->prefix('users')->group(function (){
    Route::get('/','index');
    Route::get('{id}','show');
    Route::post('/','save');
    Route::delete('/','delete');
});
Route::controller(UserController::class)->prefix('account')->group(function (){
    Route::get('/','index');
    Route::get('{id}','show');
    Route::post('/','save');
    Route::delete('/','delete');
});
