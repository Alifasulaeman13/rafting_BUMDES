<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Boat;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreBoatRequest;
use App\Http\Requests\Admin\UpdateBoatRequest;

class BoatController extends Controller
{
    public function index()
    {
        $boats = Boat::orderBy('code')->paginate(10);
        return view('admin.boats.index', compact('boats'));
    }

    public function store(StoreBoatRequest $request)
    {
        $data = $request->validated();
        Boat::create($data);
        return redirect()->route('admin.boats.index')->with('success', 'Perahu berhasil ditambahkan');
    }

    public function create()
    {
        return view('admin.boats.create');
    }

    public function show(Boat $boat)
    {
        return view('admin.boats.edit', compact('boat'));
    }

    public function update(UpdateBoatRequest $request, Boat $boat)
    {
        $data = $request->validated();
        $boat->update($data);
        return redirect()->route('admin.boats.index')->with('success', 'Perahu berhasil diperbarui');
    }

    public function destroy(Boat $boat)
    {
        $boat->delete();
        return redirect()->route('admin.boats.index')->with('success', 'Perahu berhasil dihapus');
    }
}