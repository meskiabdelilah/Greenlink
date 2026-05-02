<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::query()
            ->withCount('redemptions')
            ->latest()
            ->get();

        return view('admin.rewards.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.rewards.create');
    }

    public function store(Request $request)
    {
        $fields = $request->validate($this->rules());

        Voucher::create($fields);

        return redirect()
            ->route('admin.rewards.index')
            ->with('success', 'Récompense créée avec succès');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.rewards.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $fields = $request->validate($this->rules());

        $voucher->update($fields);

        return redirect()
            ->route('admin.rewards.index')
            ->with('success', 'Récompense mise à jour avec succès');
    }

    public function destroy(Voucher $voucher)
    {
        if ($voucher->redemptions()->exists()) {
            return redirect()
                ->route('admin.rewards.index')
                ->with('error', 'Impossible de supprimer une récompense déjà échangée.');
        }

        $voucher->delete();

        return redirect()
            ->route('admin.rewards.index')
            ->with('success', 'Récompense supprimée avec succès');
    }

    private function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'points_required' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ];
    }
}
