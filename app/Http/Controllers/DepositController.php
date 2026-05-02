<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\WasteCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class DepositController extends Controller
{
    // list deposits (user)
    public function index(Request $request)
    {
        $deposits = Deposit::where('citizen_id', $request->user()->id)
            ->with('category')
            ->latest()
            ->get();

        return view('citizen.deposits.index', compact('deposits'));
    }

    // show create form
    public function create()
    {
        $categories = WasteCategory::all();
        return view('citizen.deposits.create', compact('categories'));
    }

    // store deposit
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:waste_categories,id',
            'estimated_weight' => 'required|numeric|min:0.1',
            'address' => 'required|string|min:10',
            'city' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = $request->hasFile('photo')
            ? $request->file('photo')->store('deposits', 'public')
            : null;

        Deposit::create([
            'citizen_id' => $request->user()->id,
            'category_id' => $request->category_id,
            'estimated_weight' => $request->estimated_weight,
            'address' => $request->address,
            'city' => $request->city,
            'photo_path' => $photoPath,
            'status' => 'pending',
        ]);

        return redirect()->route('citizen.deposits.index')
            ->with('success', 'Dépôt créé avec succès');
    }

    // show one deposit
    public function show(Deposit $deposit, Request $request)
    {
        if ($deposit->citizen_id !== $request->user()->id) {
            return back()->with('error', 'Action non autorisée');
        }

        $deposit->load('category');

        return view('citizen.deposits.show', compact('deposit'));
    }

    // edit deposit
    public function edit(Deposit $deposit, Request $request)
    {
        if ($deposit->citizen_id !== $request->user()->id) {
            abort(403);
        }

        if (strtolower($deposit->status) !== 'pending') {
            return back()->with('error', 'Vous pouvez seulement modifier les dépôts en attente.');
        }

        $categories = WasteCategory::all();

        return view('citizen.deposits.edit', compact('deposit', 'categories'));
    }

    // update deposit
    public function update(Request $request, Deposit $deposit)
    {
        if ($deposit->citizen_id !== $request->user()->id) {
            abort(403);
        }


        if (strtolower($deposit->status) !== 'pending') {
            return redirect()->route('citizen.deposits.index')
                ->with('error', 'Seuls les dépôts en attente peuvent être mis à jour.');
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:waste_categories,id',
            'estimated_weight' => 'required|numeric|min:0.1',
            'city' => 'required|string|max:255',
            'address' => 'required|string|min:10',
        ]);

        $deposit->update($validated);

        return redirect()->route('citizen.deposits.index')
            ->with('success', 'Dépôt mis à jour avec succès !');
    }

    // delete deposit 
    public function destroy(Deposit $deposit, Request $request)
    {

        if ($deposit->citizen_id !== $request->user()->id) {
            return back()->with('error', 'Action non autorisée');
        }

        if (strtolower($deposit->status) !== 'pending') {
            return redirect()->route('citizen.deposits.index')
                ->with('error', 'Seuls les dépôts en attente peuvent être supprimés.');
        }

        if ($deposit->photo_path) {
            Storage::disk('public')->delete($deposit->photo_path);
        }

        $deposit->delete();


        return redirect()->route('citizen.deposits.index')->with('success', 'Dépôt supprimé avec succès');
    }
}
