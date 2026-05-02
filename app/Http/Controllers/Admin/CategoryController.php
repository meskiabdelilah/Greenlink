<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WasteCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show list page
    public function index()
    {
        $categories = WasteCategory::latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255|unique:waste_categories,name',
            'description' => 'nullable|string',
            'points_per_kg' => 'required|numeric|min:0',
            'co2_saved_per_kg' => 'required|numeric|min:0',
        ]);

        WasteCategory::create($fields);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès');
    }

    // Show edit form
    public function edit(WasteCategory $wasteCategory)
    {
        return view('admin.categories.edit', compact('wasteCategory'));
    }

    // Update category
    public function update(Request $request, WasteCategory $wasteCategory)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255|unique:waste_categories,name,' . $wasteCategory->id,
            'description' => 'nullable|string',
            'points_per_kg' => 'required|numeric|min:0',
            'co2_saved_per_kg' => 'required|numeric|min:0',
        ]);

        $wasteCategory->update($fields);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie mise à jour avec succès');
    }

    // Delete category
    public function destroy(WasteCategory $wasteCategory)
    {
        $wasteCategory->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès');
    }
}
