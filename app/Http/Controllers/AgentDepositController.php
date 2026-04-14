<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentDepositController extends Controller
{
    private function checkAgentAccess(Request $request)
    {
        if (
            $request->user()->role !== 'agent' ||
            !$request->user()->is_verified ||
            $request->user()->is_banned
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        return null;
    }

    public function pending(Request $request)
    {
        if ($response = $this->checkAgentAccess($request)) {
            return $response;
        }

        $deposits = Deposit::where('status', 'pending')
            ->with(['citizen', 'category'])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Pending deposits fetched successfully',
            'data' => $deposits,
        ]);
    }

    public function assign(Deposit $deposit, Request $request)
    {
        if ($response = $this->checkAgentAccess($request)) {
            return $response;
        }

        if ($deposit->status !== 'pending') {
            return response()->json([
                'message' => 'This deposit is not available for assignment'
            ], 400);
        }

        $deposit->update([
            'agent_id' => $request->user()->id,
            'status' => 'assigned',
        ]);

        return response()->json([
            'message' => 'Deposit assigned successfully',
            'data' => $deposit->load(['citizen', 'agent', 'category']),
        ]);
    }

    public function validateDeposit(Deposit $deposit, Request $request)
    {
        
        if ($response = $this->checkAgentAccess($request)) {
            return $response;
        }

        if ($deposit->agent_id !== $request->user()->id) {
            return response()->json([
                'message' => 'You are not assigned to this deposit'
            ], 403);
        }

        if ($deposit->status !== 'assigned') {
            return response()->json([
                'message' => 'This deposit cannot be validated'
            ], 400);
        }

        if ($deposit->pointTransaction) {
            return response()->json([
                'message' => 'Points already granted for this deposit'
            ], 400);
        }

        $fields = $request->validate([
            'actual_weight' => 'required|numeric|min:0.1',
        ]);

        $updatedDeposit = DB::transaction(function () use ($deposit, $fields) {
            $points = $fields['actual_weight'] * 10;

            $deposit->update([
                'actual_weight' => $fields['actual_weight'],
                'status' => 'validated',
                'validated_at' => now(),
            ]);

            PointTransaction::create([
                'user_id' => $deposit->citizen_id,
                'deposit_id' => $deposit->id,
                'points' => $points,
                'type' => 'earn',
            ]);

            $deposit->citizen->increment('points', $points);

            return $deposit->load(['citizen', 'agent', 'category', 'pointTransaction']);
        });

        return response()->json([
            'message' => 'Deposit validated and points granted successfully',
            'data' => $updatedDeposit,
        ]);
    }
}