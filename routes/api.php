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
    Route::get('schedule', [SiteController::class, 'schedule']);
    Route::get('schedule/{code}', [SiteController::class, 'scheduleEvent']);
    Route::get('events-categories', [SiteController::class, 'eventsByCategory']);
    Route::get('gyms/{slug}', [SiteController::class, 'showGym']);
    Route::get('partners', [SiteController::class, 'partners']);
    Route::get('workouts', [SiteController::class, 'workouts']);
    Route::get('subscriptions', [SiteController::class, 'subscriptions']);
    Route::get('leases', [SiteController::class, 'leases']);
    Route::get('business', [SiteController::class, 'business']);
    Route::get('products/{slug}', [SiteController::class, 'showProduct']);

    Route::get('contact', [SiteController::class, 'business']);

    Route::post('ebook-download', [SiteController::class, 'ebookDownload']);

    Route::prefix('customers')->group(function () {
        Route::post('/pre-registration', [CustomerController::class, 'customerPreRegistration']);
    });

    Route::post('contact-form', [SiteController::class, 'contactForm']);
});
