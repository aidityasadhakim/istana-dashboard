<?php

use App\Http\Controllers\API\ProfitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(ProfitController::class)->group(function () {
    Route::get("profit/show/{id}", 'show');
    Route::post("profit/total", 'profitBetweenDate');
    Route::get("profit/today", 'profitToday');
    Route::get("profit/thismonth", 'profitThisMonth');
    Route::get("profit/lastmonth", 'profitLastMonth');
    Route::get("profit/thisweek", 'profitThisWeek');
    Route::get("profit/test", 'profitTest');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
