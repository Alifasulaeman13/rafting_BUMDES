<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BoatmanController extends Controller
{
    public function index()
    {
        $boatmen = User::where('role', 'boatman')->latest()->paginate(10);
        return view('admin.boatmen.index', compact('boatmen'));
    }

    public function create()
    {
        return view('admin.boatmen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|string|max:20',
        ]);

        $validated['role'] = 'boatman';
        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('admin.boatmen.index')
            ->with('success', 'Ojek perahu berhasil ditambahkan');
    }

    public function edit(User $boatman)
    {
        return view('admin.boatmen.edit', compact('boatman'));
    }

    public function update(Request $request, User $boatman)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $boatman->id,
            'phone' => 'required|string|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $boatman->update($validated);

        return redirect()->route('admin.boatmen.index')
            ->with('success', 'Data ojek perahu berhasil diperbarui');
    }

    public function destroy(User $boatman)
    {
        $boatman->delete();

        return redirect()->route('admin.boatmen.index')
            ->with('success', 'Ojek perahu berhasil dihapus');
    }
}