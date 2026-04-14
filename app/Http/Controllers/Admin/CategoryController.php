<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WasteCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $categories = WasteCategory::latest()->get();

        return response()->json([
            'message' => 'Categories fetched successfully',
            'data' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $fields = $request->validate([
            'name' => 'required|string|max:255|unique:waste_categories,name',
            'description' => 'nullable|string',
            'points_per_kg' => 'nullable|numeric|min:0',
            'co2_saved_per_kg' => 'required|numeric|min:0',
        ]);

        $category = WasteCategory::create($fields);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category,
        ], 201);
    }

    public function update(WasteCategory $wasteCategory, Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $fields = $request->validate([
            'name' => 'required|string|max:255|unique:waste_categories,name,' . $wasteCategory->id,
            'description' => 'nullable|string',
            'points_per_kg' => 'nullable|numeric|min:0',
            'co2_saved_par_kg' => 'required|numeric|min:0',
        ]);

        $wasteCategory->update($fields);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $wasteCategory,
        ]);
    }

    public function destroy(WasteCategory $wasteCategory, Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $wasteCategory->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}