<?php

namespace App\Http\Controllers;

use App\Models\Deposit;

class DashboardController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with('category', 'citizen')->latest()->get();

        return view('dashboard', compact('deposits'));
    }
}
