<?php

use App\Http\Controllers\Api\Public\Customer\CustomerController;
use App\Http\Controllers\Api\Public\SiteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('public')->group(function () {
    Route::get('gyms', [SiteController::class, 'gyms']);
    Route::get('gyms/{gym}', [SiteController::class, 'showGym']);
    Route::get('partners', [SiteController::class, 'partners']);
    Route::get('workouts', [SiteController::class, 'workouts']);
    Route::get('subscriptions', [SiteController::class, 'subscriptions']);
    Route::get('leases', [SiteController::class, 'leases']);
    Route::get('business', [SiteController::class, 'business']);

    Route::prefix('customers')->group(function(){
        Route::post('/pre-cadastro', [CustomerController::class, 'customerPreRegistration']);
    });
});
