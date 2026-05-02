<?php

namespace App\Http\Controllers;

use App\Models\PointTransaction;
use App\Models\Voucher;
use App\Models\VoucherRedemption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PointController extends Controller
{
    // Afficher le catalogue des recompenses et l'historique des echanges
    public function myRewards(Request $request)
    {
        $user = $request->user();

        $vouchers = Voucher::query()
            ->orderBy('points_required')
            ->orderBy('title')
            ->get();

        $redemptions = VoucherRedemption::query()
            ->where('user_id', $user->id)
            ->with('voucher')
            ->latest('redeemed_at')
            ->latest()
            ->take(6)
            ->get();

        $transactions = PointTransaction::query()
            ->where('user_id', $user->id)
            ->with('deposit.category')
            ->latest()
            ->take(5)
            ->get();

        $pointsBalance = $user->points ?? 0;
        $totalRedeemed = VoucherRedemption::query()
            ->where('user_id', $user->id)
            ->sum('points_spent');
        $availableRewards = Voucher::query()
            ->where('stock', '>', 0)
            ->count();

        return view('citizen.rewards.index', compact(
            'user',
            'vouchers',
            'redemptions',
            'transactions',
            'pointsBalance',
            'totalRedeemed',
            'availableRewards'
        ));
    }

    // Echanger un bon avec les points du citoyen
    public function redeem(Request $request, Voucher $voucher)
    {
        DB::transaction(function () use ($request, $voucher) {
            $user = $request->user()
                ->newQuery()
                ->whereKey($request->user()->id)
                ->lockForUpdate()
                ->firstOrFail();

            $voucher = Voucher::query()
                ->whereKey($voucher->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($voucher->stock < 1) {
                throw ValidationException::withMessages([
                    'reward' => 'Cette récompense est en rupture de stock.',
                ]);
            }

            if ($user->points < $voucher->points_required) {
                throw ValidationException::withMessages([
                    'reward' => 'Vous n’avez pas assez de GreenPoints pour cette récompense.',
                ]);
            }

            $user->decrement('points', $voucher->points_required);
            $voucher->decrement('stock');

            VoucherRedemption::create([
                'user_id' => $user->id,
                'voucher_id' => $voucher->id,
                'points_spent' => $voucher->points_required,
                'status' => 'pending',
                'redeemed_at' => now(),
            ]);
        });

        return redirect()
            ->route('citizen.rewards.index')
            ->with('success', 'Récompense échangée avec succès.');
    }

    // Afficher les points de l'utilisateur
    public function myPoints(Request $request)
    {
        $user = $request->user()->loadCount('pointTransactions');

        return view('points.index', [
            'user' => $user,
        ]);
    }

    // Afficher les transactions
    public function myTransactions(Request $request)
    {
        $transactions = PointTransaction::where('user_id', $request->user()->id)
            ->with('deposit.category')
            ->latest()
            ->get();

        return view('points.transactions', compact('transactions'));
    }
}
