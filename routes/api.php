<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);

Route::controller(UserController::class)->prefix('users')->group(function (){
    Route::get('/','index');
    Route::get('{id}','show');
    Route::post('/','save');
    Route::delete('/{id}','delete');
});
Route::controller(AccountController::class)->prefix('account')->group(function (){
    Route::get('/','index');
    Route::get('{id}','show');
    Route::get('pdf','pdf_download');
});
