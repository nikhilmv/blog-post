<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;

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

// Public routes of authtication
Route::controller(UserController::class)->group(function() {
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/getPostInformation', [UserController::class, 'getPostInformation']);
});


