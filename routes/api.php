<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MyOfficeLeadsIntegrationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ArtisanTerminalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
////hello 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//
Route::post('/indiamart-webhook', [MyOfficeLeadsIntegrationController::class, 'indiamart_webhook']);
Route::get('/facebook-webhook', [MyOfficeLeadsIntegrationController::class, 'facebook_webhook']);
Route::any('/webhook/{type}/{id?}', [MyOfficeLeadsIntegrationController::class, 'webhook']);

Route::post('/check-office', [LocationController::class, 'checkOfficeArea']);
Route::get('/cronjob-notification', [NotificationController::class, 'cronjob_notification']);

Route::any('/employees/offline-all', [ArtisanTerminalController::class, 'offlineAll']);
