<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\DimPlant;
use Illuminate\Http\Request;

class UserCatalogController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua catalog/types
        $catalogs = Catalog::with(['plants.image'])->get();
        
        // Ambil plants dengan filter jika ada
        $selectedType = $request->get('type', 'all');
        
        if ($selectedType === 'all') {
            $plants = DimPlant::with(['type', 'image'])->get();
        } else {
            $plants = DimPlant::with(['type', 'image'])
                ->where('Type_ID', $selectedType)
                ->get();
        }
        
        // Ambil featured catalogs untuk section utama
        $featuredCatalogs = $catalogs->take(3);
        
        return view('user.catalog', compact('catalogs', 'plants', 'selectedType', 'featuredCatalogs'));
    }

    public function show($typeId)
    {
        $catalog = Catalog::with(['plants.image'])->findOrFail($typeId);
        $plants = $catalog->plants()->with('image')->get();
        
        return view('user.catalog-detail', compact('catalog', 'plants'));
    }
}