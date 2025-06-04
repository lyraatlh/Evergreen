<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DimPlant;
use App\Models\Catalog;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        // if (! Gate::allows('view-plant')) {
        //     abort(401);
        // }

        $plants = DimPlant::with('type')->get();
        return view('admin.plants.index', compact('plants'));
    }

    public function create()
    {
        // if (! Gate::allows('store-plant')) {
        //     abort(401);
        // }

        $types = Catalog::all();
        return view('admin.plants.create', compact('types'));
    }

    public function store(Request $request)
    {
        // if (! Gate::allows('store-plant')) {
        //     abort(401);
        // }

        $validated = $request->validate([
            'Plant_ID' => 'required|unique:dim_plant,Plant_ID',
            'Plant_Name' => 'required|string|max:255',
            'Type_ID' => 'required|exists:plant_type,Type_ID',
            'Price' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $plant = DimPlant::create([
            'Plant_ID' => $validated['Plant_ID'],
            'Plant_Name' => $validated['Plant_Name'],
            'Type_ID' => $validated['Type_ID'],
            'Price' => $validated['Price'],
            'Stock' => $validated['Stock'],
        ]);

        // Simpan gambar jika ada input
        if ($request->has('image_url') && $request->image_url != null) {
            \App\Models\PlantImage::create([
                'Plant_ID' => $plant->Plant_ID,
                'image_url' => $request->image_url,
            ]);
        }

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('plant_images', 'public');
            \App\Models\PlantImage::create([
                'Plant_ID' => $plant->Plant_ID,
                'image_url' => '/storage/' . $path,
            ]);
        }

        return redirect()->route('admin.plants.index')->with('success', 'Plant created successfully');
    }

    public function show($id)
    {
        // if (! Gate::allows('view-plant')) {
        //     abort(401);
        // }

        $plant = DimPlant::with('type', 'image')->findOrFail($id);
        return view('admin.plants.show', compact('plant'));
    }

    public function edit($id)
    {
        // if (! Gate::allows('edit-plant')) {
        //     abort(401);
        // }

        $plant = DimPlant::findOrFail($id);
        $types = Catalog::all();
        return view('admin.plants.edit', compact('plant', 'types'));
    }

    public function update(Request $request, $id)
    {
        // if (! Gate::allows('edit-plant')) {
        //     abort(401);
        // }

        $plant = DimPlant::findOrFail($id);

        $validated = $request->validate([
            'Plant_ID' => 'required|exists:dim_plant,Plant_ID',
            'Plant_Name' => 'required|string|max:255',
            'Type_ID' => 'required|exists:plant_type,Type_ID',
            'Price' => 'required|numeric|min:0',
            'Stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $plant->update([
            'Plant_ID' => $validated['Plant_ID'],
            'Plant_Name' => $validated['Plant_Name'],
            'Type_ID' => $validated['Type_ID'],
            'Price' => $validated['Price'],
            'Stock' => $validated['Stock'],
        ]);

        // Hapus gambar lama jika ada update gambar baru
        if ($request->has('image_url') && $request->image_url != null) {
            // Hapus semua image lama
            $plant->image()->delete();

            // Simpan image baru dari URL
            \App\Models\PlantImage::create([
                'Plant_ID' => $plant->Plant_ID,
                'image_url' => $request->image_url,
            ]);
        }

        if ($request->hasFile('image_upload')) {
            // Hapus semua image lama
            $plant->image()->delete();

            // Upload dan simpan image baru dari file
            $path = $request->file('image_upload')->store('plant_images', 'public');

            \App\Models\PlantImage::create([
                'Plant_ID' => $plant->Plant_ID,
                'image_url' => '/storage/' . $path,
            ]);
        }

        return redirect()->route('admin.plants.index')->with('success', 'Plant updated successfully');
    }

    public function destroy($id)
    {
        // if (! Gate::allows('destroy-plant')) {
        //     abort(401);
        // }

        $plant = DimPlant::findOrFail($id);
        $plant->delete();

        return redirect()->route('admin.plants.index')->with('success', 'Plant deleted successfully');
    }
}