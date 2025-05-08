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
        ]);

        Catalog::create($request->all());

        return redirect()->route('catalogs.index')->with('success', 'Catalog berhasil ditambahkan.');
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
        ]);

        $catalog->update($request->all());

        return redirect()->route('catalogs.index')->with('success', 'Catalog berhasil diperbarui.');
    }

    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return redirect()->route('catalogs.index')->with('success', 'Catalog berhasil dihapus.');
    }
}