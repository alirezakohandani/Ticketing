<?php

use Modules\User\Http\Controllers\Admin\PermissionController;
use Modules\User\Http\Controllers\Admin\RoleController;
use Modules\User\Http\Controllers\Auth\AuthController;
use Modules\User\Http\Controllers\UserController;

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

Route::group(['prefix' => 'v1'], function() {
    Route::get('/users.json', [UserController::class, 'index']);
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
}); 

Route::group(['prefix' => 'v1/admin'], function() {
    Route::post('/add/role', [RoleController::class, 'store']);
    Route::post('/add/permission', [PermissionController::class, 'store']);
});
