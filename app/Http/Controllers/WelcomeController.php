<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)
                          ->orderBy('price', 'asc')
                          ->take(3)
                          ->get();

        return view('welcome', compact('packages'));
    }
}