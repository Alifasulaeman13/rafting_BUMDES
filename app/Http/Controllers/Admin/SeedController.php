<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class SeedController extends Controller
{
    public function seedDemo()
    {
        Artisan::call('db:seed');
        return response()->json(['seeded' => true]);
    }
}