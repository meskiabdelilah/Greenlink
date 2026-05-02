<?php

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/agent/deposits/pending', function (Request $request) {
    abort_if($request->user()->role !== 'agent', 403);
    abort_if(! $request->user()->is_verified, 403);

    return Deposit::where('status', 'pending')
        ->whereNull('agent_id')
        ->with('category')
        ->latest()
        ->get();
});
