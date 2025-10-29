<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        return response()->json(Package::where('is_active', true)->orderBy('name')->get());
    }

    public function show(Package $package)
    {
        return response()->json($package);
    }
}