<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\Deposit;

class DashboardController extends Controller
{

    public function index()
    {
        // Get the currently logged-in user (citizen)
        $user = auth()->user();

        // Fetch all deposits belonging to this user
        // We also load the category relationship to avoid extra queries (Eager Loading)
        $deposits = Deposit::with('category')
            ->where('citizen_id', $user->id)
            ->get();

        // Calculate total weight of all deposits (in kg)
        $totalKg = $deposits->sum('actual_weight');

        // Calculate total points earned from deposits
        // Each deposit: weight * points_per_kg from its category
        $pointsFromDeposits = $deposits->sum(function ($deposit) {
            return $deposit->actual_weight *
                ($deposit->category->points_per_kg ?? 0);
        });

        // Calculate total CO2 saved
        // Each deposit: weight * co2_saved_per_kg from its category
        $co2Saved = $deposits->sum(function ($deposit) {
            return $deposit->actual_weight *
                ($deposit->category->co2_saved_per_kg ?? 0);
        });

        $points = $user->points;

        // Send data to the Blade view (dashboard UI)
        return view('citizen.dashboard', compact('points', 'co2Saved', 'totalKg'));
    }
}
