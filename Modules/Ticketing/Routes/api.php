<?php

use Illuminate\Http\Request;
use Modules\Ticketing\Http\Controllers\Admin\ReplyController;

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

Route::group(['prefix' => 'v1'], function () { 
    Route::get('/tickets', [Modules\Ticketing\Http\Controllers\TicketingController::class, 'index']);
    Route::post('/tickets', [Modules\Ticketing\Http\Controllers\TicketingController::class, 'store']);
    Route::get('/tickets/{ticket:ref_number}', [Modules\Ticketing\Http\Controllers\TicketingController::class, 'show']); 
});

Route::group(['prefix' => 'v1/admin'], function () { 
    Route::get('/tickets', [Modules\Ticketing\Http\Controllers\Admin\TicketingController::class, 'index']); 
    Route::post('ticket/change/type', [Modules\Ticketing\Http\Controllers\Admin\TicketingController::class, 'update']);
    Route::post('tickets/{ticket:ref_number}/reply', [ReplyController::class, 'store']);
});