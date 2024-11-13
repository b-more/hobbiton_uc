<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/webhook',[App\Http\Controllers\InboxController::class, 'webhook']);
Route::post('/akros/send',[App\Http\Controllers\OutboxController::class, 'response_from_akros']);

//Add here the webhook for every new UC2000 client
Route::post('/webhook/hobbiton', [InboxController::class, 'webhookHobbiton']);
Route::post('/webhook/gamepawa', [InboxController::class, 'webhookGamepawa']);
Route::post('/webhook/akros', [InboxController::class, 'webhookAkros']);
