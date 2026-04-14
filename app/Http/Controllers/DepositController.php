<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;

class DepositController extends Controller
{

    // Post /api/deposits
    // Store a new deposit request from citizen.
    public function store(Request $request)
    {
        // Check if user is banned .
        if ($request->user()->is_banned) {
            return response()->json([
                'message' => 'Your account is banned'
            ], 403);
        }
        // 1. Validation
        $fields = $request->validate([
            'category_id' => 'required|exists:waste_categories,id',
            'estimated_weight' => 'required|numeric|min:0',
            'photo_path' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
        ]);

        // 2. Create deposit
        $deposit = Deposit::create([
            'citizen_id' => $request->user()->id,
            'category_id' => $fields['category_id'],
            'estimated_weight' => $fields['estimated_weight'],
            'photo_path' => $fields['photo_path'] ?? null,
            'address' => $fields['address'],
            'city' => $fields['city'],
            'status' => 'pending'
        ]);

        // 3. Response
        return response()->json([
            'message' => 'Deposit created successfully',
            'data' => $deposit
        ], 201);
    }


    // Get /api/deposits
    // My deposits .
    public function myDeposits(Request $request)
    {
        $deposits = Deposit::where('citizen_id', $request->user()->id)
            ->with('category') // category info
            ->latest()
            ->get();

        return response()->json([
            'message' => 'My deposits fetched successfully',
            'data' => $deposits,
        ]);
    }


    // Get /api/deposits/{id}
    // Show specific deposit details .
    public function show(Deposit $deposit, Request $request)
    {
        if ($deposit->citizen_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $deposit->load('category');

        return response()->json([
            'message' => 'Deposit fetched successfully',
            'data' => $deposit,
        ]);
    }
}
