<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\PointTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgentDepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::where('status', 'pending')
            ->whereNull('agent_id')
            ->with('category')
            ->latest()
            ->get();

        return view('agent.dashboard', compact('deposits'));
    }

    public function pending()
    {
        $deposits = Deposit::where('status', 'pending')
            ->whereNull('agent_id')
            ->with('category')
            ->latest()
            ->get();

        return view('agent.deposits.pending', compact('deposits'));
    }

    public function assign(Deposit $deposit)
    {
        if ($deposit->agent_id || $deposit->status !== 'pending') {
            return back()->with('error', 'Cette mission n est plus disponible.');
        }

        $deposit->update([
            'agent_id' => Auth::id(),
            'status' => 'assigned',
        ]);

        return redirect()
            ->route('agent.deposits.assigned')
            ->with('success', 'Objectif verrouille. En route pour la collecte !');
    }

    public function assigned()
    {
        $deposits = Deposit::where('agent_id', Auth::id())
            ->where('status', 'assigned')
            ->with('category')
            ->latest()
            ->get();

        return view('agent.deposits.assigned', compact('deposits'));
    }

    public function showValidate(Deposit $deposit)
    {
        if ($deposit->agent_id !== Auth::id()) {
            abort(403);
        }

        if ($deposit->status !== 'assigned') {
            return redirect()
                ->route('agent.deposits.assigned')
                ->with('error', 'Seules les missions assignees peuvent etre validees.');
        }

        $deposit->load('category');

        return view('agent.deposits.validate', compact('deposit'));
    }

    public function validateDeposit(Request $request, Deposit $deposit)
    {
        $request->validate([
            'actual_weight' => 'required|numeric|min:0.1',
        ]);

        DB::beginTransaction();

        try {
            $deposit->load(['category', 'citizen', 'pointTransaction']);

            if ($deposit->agent_id !== Auth::id() || $deposit->status !== 'assigned') {
                abort(403);
            }

            if ($deposit->pointTransaction) {
                DB::rollBack();

                return redirect()
                    ->route('agent.deposits.history')
                    ->with('error', 'Cette mission a deja ete creditee.');
            }

            $pointsEarned = floor($request->actual_weight * ($deposit->category?->points_per_kg ?? 0));

            $deposit->update([
                'actual_weight' => $request->actual_weight,
                'status' => 'validated',
                'collected_at' => now(),
                'validated_at' => now(),
            ]);

            PointTransaction::create([
                'user_id' => $deposit->citizen_id,
                'deposit_id' => $deposit->id,
                'points' => $pointsEarned,
                'type' => 'credit',
            ]);

            $deposit->citizen?->increment('points', $pointsEarned);

            DB::commit();

            return redirect()
                ->route('agent.dashboard')
                ->with('success', "Transaction terminee. +$pointsEarned points generes.");
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()->with('error', 'Erreur lors de la validation : ' . $e->getMessage());
        }
    }

    public function history()
    {
        $deposits = Deposit::where('agent_id', Auth::id())
            ->where('status', 'validated')
            ->with(['category', 'pointTransaction'])
            ->latest()
            ->get();

        return view('agent.deposits.history', compact('deposits'));
    }
}
