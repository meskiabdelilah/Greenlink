<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\PointTransaction;
use App\Models\User;
use App\Models\WasteCategory;

class DashboardController extends Controller
{
    public function index()
    {
        // USERS STATS
        $totalCitizens = User::where('role', 'citizen')->count();
        $totalAgents = User::where('role', 'agent')->count();

        // WASTE / ENVIRONMENT STATS


        // Total weight (real + fallback)
        $totalWeight = Deposit::sum('actual_weight');

        // Total CO2 saved (dynamic per category)
        $totalCO2 = Deposit::with('category')
            ->get()
            ->sum(function ($deposit) {
                $weight = $deposit->actual_weight ?? 0;
                $co2PerKg = $deposit->category->co2_saved_per_kg ?? 0;
                return $weight * $co2PerKg;
            });

        // POINTS

        $totalPoints = PointTransaction::sum('points');
        // CATEGORIES

        $categoriesCount = WasteCategory::count();


        return view('admin.dashboard', compact(
            'totalCitizens',
            'totalAgents',
            'totalWeight',
            'totalCO2',
            'totalPoints',
            'categoriesCount',
        ));
    }
}
