<?php

use Illuminate\Http\Request;
use Modules\User\Http\Controllers\Admin\AdminController;
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
}); 

Route::group(['prefix' => 'v1/admin'], function() {
    Route::post('/add/role', [AdminController::class, 'storeRole']);
    Route::post('/add/permission', [AdminController::class, 'storePermission']);
});