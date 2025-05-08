<?php

namespace App\Http\Controllers;

use App\Models\DimPlant;
use App\Models\Catalog;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPlants = DimPlant::count();
        $totalCatalogs = Catalog::count();

        $catalogs = Catalog::withCount('plants')->get();

        return view('dashboard', compact('totalPlants', 'totalCatalogs', 'catalogs'));
    }
}