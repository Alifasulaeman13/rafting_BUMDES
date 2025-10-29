<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('name')->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(StorePackageRequest $request)
    {
        try {
            $data = $request->validated();
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $imagePath = $file->store('packages', 'public');
                    $data['image'] = $imagePath;
                } else {
                    throw new Exception('File upload failed: ' . $file->getErrorMessage());
                }
            }

            $package = Package::create($data);
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Paket berhasil ditambahkan',
                    'data' => $package
                ]);
            }
            return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan.');
        } catch (Exception $e) {
            Log::error('Error creating package: ' . $e->getMessage());
            
            // Return JSON response untuk error
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan paket: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(UpdatePackageRequest $request, Package $package)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    // Hapus gambar lama jika ada
                    if ($package->image) {
                        Storage::disk('public')->delete($package->image);
                    }
                    
                    $imagePath = $file->store('packages', 'public');
                    $data['image'] = $imagePath;
                } else {
                    throw new Exception('File upload failed: ' . $file->getErrorMessage());
                }
            }

            $package->update($data);
            return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui.');
        } catch (Exception $e) {
            Log::error('Error updating package: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui paket: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Package $package)
    {
        try {
            // Hapus gambar jika ada
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }

            $package->delete();
            return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus.');
        } catch (Exception $e) {
            Log::error('Error deleting package: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus paket: ' . $e->getMessage()
            ], 500);
        }
    }
}