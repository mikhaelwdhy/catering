<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $packages = Package::with('category')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($request->category_id, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('admin.packages.index', compact('packages', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.packages.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:5000'],
            'min_order' => ['required', 'integer', 'min:1'],
            'daily_quota' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        Package::create($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket catering berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        $categories = Category::all();
        return view('admin.packages.edit', compact('package', 'categories'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:5000'],
            'min_order' => ['required', 'integer', 'min:1'],
            'daily_quota' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($package->image && Storage::disk('public')->exists($package->image)) {
                Storage::disk('public')->delete($package->image);
            }
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket catering berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        if ($package->orders()->exists()) {
            return back()->with('error', 'Paket tidak dapat dihapus karena sudah memiliki riwayat pesanan.');
        }

        if ($package->image && Storage::disk('public')->exists($package->image)) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket catering berhasil dihapus.');
    }
}