<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\CashController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProfitController;
use App\Http\Controllers\API\SalesTransactionController;
use App\Http\Controllers\API\ServicesTransactionController;

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
    Route::post("profit/custom", 'profitBetweenDate');
    Route::get("profit/today", 'profitToday');
    Route::get("profit/thismonth", 'profitThisMonth');
    Route::get("profit/lastmonth", 'profitLastMonth');
    Route::get("profit/thisweek", 'profitThisWeek');
    Route::get("profit/test", 'profitTest');
});

Route::controller(CashController::class)->group(function () {
    Route::get("cash/today", "cashToday");
    Route::get("cash/thismonth", "cashThisMonth");
    Route::get("cash/lastmonth", "cashLastMonth");
    Route::get("cash/thisweek", "cashThisWeek");
    Route::post("cash/custom", "cashBetweenDate");
    Route::get("cash/test", "cashTest");
});

Route::controller(CardController::class)->group(function () {
    Route::get("card/today", "cardToday");
    Route::get("card/thismonth", "cardThisMonth");
    Route::get("card/lastmonth", "cardLastMonth");
    Route::get("card/thisweek", "cardThisWeek");
    Route::post("card/custom", "cardBetweenDate");
    Route::get("card/test", "cardTest");
});

Route::controller(OrderController::class)->group(function () {
    Route::get("order/today", "orderToday");
    Route::get("order/thismonth", "orderThisMonth");
    Route::get("order/lastmonth", "orderLastMonth");
    Route::get("order/thisweek", "orderThisWeek");
    Route::post("order/custom", "orderBetweenDate");
    Route::get("order/test", "orderTest");
});

Route::controller(SalesTransactionController::class)->group(function () {
    Route::get("salestransaction/today", "salesTransactionToday");
    Route::get("salestransaction/thismonth", "salesTransactionThisMonth");
    Route::get("salestransaction/lastmonth", "salesTransactionLastMonth");
    Route::get("salestransaction/thisweek", "salesTransactionThisWeek");
    Route::post("salestransaction/custom", "salesTransactionBetweenDate");
    Route::get("salestransaction/test", "salesTransactionTest");
});

Route::controller(ServicesTransactionController::class)->group(function () {
    Route::get("servicestransaction/today", "servicesTransactionToday");
    Route::get("servicestransaction/thismonth", "servicesTransactionThisMonth");
    Route::get("servicestransaction/lastmonth", "servicesTransactionLastMonth");
    Route::get("servicestransaction/thisweek", "servicesTransactionThisWeek");
    Route::post("servicestransaction/custom", "servicesTransactionBetweenDate");
    Route::get("servicestransaction/test", "servicesTransactionTest");
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
