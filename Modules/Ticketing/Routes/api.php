<?php

use Illuminate\Http\Request;
use Modules\Ticketing\Http\Controllers\TicketingController;

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
    Route::post('/tickets', [TicketingController::class, 'store']);
    Route::get('/tickets/{ticket:ref_number}', [TicketingController::class, 'show']); 
});