<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::all();
        return view('catalogs.index', compact('catalogs'));
    }

    public function create()
    {
        return view('catalogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Type_Name' => 'required|string|max:255',
            'Type_ID' => 'required|unique:plant_type,Type_ID',
        ]);

        Catalog::create($request->all());

        return redirect()->route('catalogs.index')->with('success', 'Catalog created successfully');
    }

    public function show(Catalog $catalog)
    {
        return view('catalogs.show', compact('catalog'));
    }

    public function edit(Catalog $catalog)
    {
        return view('catalogs.edit', compact('catalog'));
    }

    public function update(Request $request, Catalog $catalog)
    {
        $request->validate([
            'Type_Name' => 'required|string|max:255',
            'Type_ID' => 'required|unique:plant_type,Type_ID,' . $catalog->Type_ID . ',Type_ID',
        ]);

        $catalog->update($request->all());

        return redirect()->route('catalogs.index')->with('success', 'Catalog updated successfully');
    }

    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return redirect()->route('catalogs.index')->with('success', 'Catalog deleted successfully');
    }
}