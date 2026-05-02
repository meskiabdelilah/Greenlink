<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Deposit;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingCount = Deposit::where('status', 'pending')
            ->whereNull('agent_id')
            ->count();
        $assignedCount = Deposit::where('agent_id', auth()->id())
            ->where('status', 'assigned')
            ->count();

        $allPending = Deposit::with('category')
            ->where('status', 'pending')
            ->whereNull('agent_id')
            ->latest()
            ->get();

        return view('agent.dashboard', compact('pendingCount', 'assignedCount', 'allPending'));
    }
}
