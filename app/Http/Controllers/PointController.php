<?php

namespace App\Http\Controllers;

use App\Models\PointTransaction;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function myPoints(Request $request)
    {
        $user = $request->user()->loadCount('pointTransactions');

        return response()->json([
            'message' => 'Points fetched successfully',
            'data' => [
                'user_id' => $user->id,
                'points' => $user->points,
                'transactions_count' => $user->point_transactions_count,
            ],
        ]);
    }

    public function myTransactions(Request $request)
    {
        $transactions = PointTransaction::where('user_id', $request->user()->id)
            ->with('deposit.category')
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Point transactions fetched successfully',
            'data' => $transactions,
        ]);
    }
}
