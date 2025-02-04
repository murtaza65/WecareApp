<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReminderControllerAPI;
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
// Route::post('/chat/send', [ChatController::class, 'sendMessage']);

// Route::post('/chat/send', [ChatController::class, 'botChat']);
// Route::post('/chat/send', [ChatController::class, 'getAIResponse']);

// Route::post('/chat/send', [ChatController::class, 'recipeApi2']);

Route::post('/chat/send', [ChatController::class, 'getGeminiAIResponse']);

Route::resource('reminders', ReminderControllerAPI::class);
