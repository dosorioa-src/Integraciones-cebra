<?php

use App\Http\Controllers\Api\UserController;
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
Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::post('contact', [UserController::class, 'contact']);
    Route::post('company-padre', [UserController::class, 'companypadre']);
    Route::post('company-hijo', [UserController::class, 'companyhijo']);
    Route::post('sell-in', [UserController::class, 'sellin']);
    Route::post('sell-out', [UserController::class, 'sellout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
