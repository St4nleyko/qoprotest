<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('/issue-token', [AuthController::class, 'issueToken'])->name('token.issue');
Route::get('/issue-token-view', [AuthController::class, 'issueTokenView'])->name('token.issue.view');
//routes expect auth header with jwt token (normally stored on client)
Route::middleware('auth:api')->group(function () {
    Route::post('/revoke-token', [AuthController::class, 'revokeToken'])->name('token.revoke');
});
