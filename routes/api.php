<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [ProfileController::class, 'profile']);

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'save');
        Route::delete('/{id}', 'delete');
    });
    Route::controller(AccountController::class)->prefix('account')->group(function () {
        Route::get('/', 'index');
        Route::get('{id}', 'show');
        Route::post('/', 'save');
        Route::delete('/{id}', 'delete');
    });
    Route::controller(RolesController::class)->prefix('roles')->group(function () {
        Route::get('/', 'index');
        // Route::get('{id}', 'show');
        Route::post('/', 'save');
        Route::delete('/{id}', 'delete');
    });
    Route::controller(PermissionsController::class)->prefix('permissions')->group(function () {
        Route::get('/', 'index');
        // Route::get('{id}', 'show');
        Route::post('/', 'save');
        Route::delete('/{id}', 'delete');
    });



});
