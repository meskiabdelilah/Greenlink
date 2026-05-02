<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with(['citizen', 'agent', 'category', 'pointTransaction'])->latest()->get();
        return view('admin.deposits.index', compact('deposits'));
    }

    public function show(Deposit $deposit)
    {
        $deposit->load(['citizen', 'agent', 'category', 'pointTransaction']);
        return view('admin.deposits.show', compact('deposit'));
    }
}
