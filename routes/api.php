<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AgentDepositController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PointController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);


    Route::post('/deposits', [DepositController::class, 'store']);
    Route::get('/deposits', [DepositController::class, 'myDeposits']);
    Route::get('/deposits/{deposit}', [DepositController::class, 'show']);
    Route::get('/agent/deposits/pending', [AgentDepositController::class, 'pending']);
    Route::post('/agent/deposits/{deposit}/assign', [AgentDepositController::class, 'assign']);
    Route::post('/agent/deposits/{deposit}/validate', [AgentDepositController::class, 'validateDeposit']);


    Route::get('/my-points', [PointController::class, 'myPoints']);
    Route::get('/my-point-transactions', [PointController::class, 'myTransactions']);

    Route::prefix('admin')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{wasteCategory}', [CategoryController::class, 'update']);
        Route::delete('/categories/{wasteCategory}', [CategoryController::class, 'destroy']);


        Route::patch('users/{user}/verify-agent', [AdminUserController::class, 'verifyAgent']);
        Route::patch('users/{user}/unverify-agent', [AdminUserController::class, 'unverifyAgent']);

        Route::patch('users/{user}/ban', [AdminUserController::class, 'banUser']);
        Route::patch('users/{user}/unban', [AdminUserController::class, 'unbanUser']);
    });
});
