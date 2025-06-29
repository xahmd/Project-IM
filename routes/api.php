<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::get('/leaves/range', [LeaveApiController::class, 'getLeavesInDateRange']);
    Route::get('/leaves/summary', [LeaveApiController::class, 'getLeaveSummary']);
    Route::get('/leaves/today', [LeaveApiController::class, 'getStaffOnLeave']);
});
