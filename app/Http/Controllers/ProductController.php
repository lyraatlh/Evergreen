<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DimPlant;
use App\Models\Catalog;

class ProductController extends Controller
{
    public function index()
    {
        $plants = DimPlant::with('type')->get();
        return view('plants.index', compact('plants'));
    }

    public function create()
    {
        $types = Catalog::all();
        return view('plants.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Plant_Name' => 'required|string|max:255',
            'Type_ID' => 'required|exists:plant_type,Type_ID',
            'Price' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
        ]);

        DimPlant::create([
            'Plant_Name' => $validated['Plant_Name'],
            'Type_ID' => $validated['Type_ID'],
            'Price' => $validated['Price'],
            'Stock' => $validated['Stock'],
        ]);

        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $plant = DimPlant::with('type', 'image')->findOrFail($id);
        return view('plants.show', compact('plant'));
    }

    public function edit($id)
    {
        $plant = DimPlant::findOrFail($id);
        $types = Catalog::all(); // ganti dari $catalogs ke $types
        return view('plants.edit', compact('plant', 'types'));
    }

    public function update(Request $request, $id)
    {
        $plant = DimPlant::findOrFail($id);

        $validated = $request->validate([
            'Plant_Name' => 'required|string|max:255',
            'Type_ID' => 'required|exists:plant_type,Type_ID',
            'Price' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
        ]);

        $plant->update([
            'Plant_Name' => $validated['Plant_Name'],
            'Type_ID' => $validated['Type_ID'],
            'Price' => $validated['Price'],
            'Stock' => $validated['Stock'],
        ]);

        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $plant = DimPlant::findOrFail($id);
        $plant->delete();

        return redirect()->route('plants.index')->with('success', 'Tanaman berhasil dihapus.');
    }
}