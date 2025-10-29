<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Update the settings.
     */
    public function update(Request $request)
    {
        // TODO: Implement settings update logic
        return redirect()->route('admin.settings')->with('success', 'Pengaturan berhasil diperbarui');
    }
}