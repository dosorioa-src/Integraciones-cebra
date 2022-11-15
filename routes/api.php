<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Contacts\ContactController;
use App\Http\Controllers\Api\Company\CompanyController;
use App\Http\Controllers\Api\Company\CompanyChildController;
use App\Http\Controllers\Api\Sell\SellinController;
use App\Http\Controllers\Api\Sell\SelloutController;
use App\Http\Controllers\Api\Company\CompanyContactController;
use App\Http\Controllers\Api\Company\CompanySellinController;
use App\Http\Controllers\Api\Company\CompanySelloutController;
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
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

//Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::post('contact/store', [ContactController::class, 'store']);
    Route::post('company/store', [CompanyController::class, 'store']);
    Route::post('company/child/store', [CompanyChildController::class, 'store']);
    Route::post('sellin/store', [SellinController::class, 'store']);
    Route::post('sellout/store', [SelloutController::class, 'store']);
    Route::put('company/contact/association', [CompanyContactController::class, 'store']);
    Route::put('company/deal/sellin/association', [CompanySellinController::class, 'store']);
    Route::put('company/child/deal/sellout/association', [CompanySelloutController::class, 'store']);
    Route::get('user-profile', [UserController::class, 'userProfile']);
//});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
