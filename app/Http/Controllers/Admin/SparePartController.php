<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SparePart;
use Illuminate\Support\Facades\Storage;


class SparePartController extends Controller
{
    // Yedek parça listesi
    public function index(Request $request)
    {
        $query = SparePart::query();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $spareParts = $query->get();
        return view('admin.spare_parts.index', compact('spareParts'));
    }

    // Yeni yedek parça ekleme formu
    public function create()
    {
        return view('admin.spare_parts.create');
    }

    // Yeni yedek parçayı kaydet
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'model' => 'nullable|string|max:100',
            'year' => 'nullable|integer',
            'category' => 'nullable|string|max:100',
            'part_brand' => 'nullable|string|max:100',
            'description' => 'required|string|max:1000',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        SparePart::create($validated);

        return redirect()->route('spare-parts.index')->with('success', 'Yedek parça eklendi!');
    }

    // Yedek parça düzenleme formu
    public function edit($id)
    {
        $sparePart = SparePart::findOrFail($id);
        return view('admin.spare_parts.edit', compact('sparePart'));
    }

    // Yedek parçayı güncelle
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'model' => 'nullable|string|max:100',
            'year' => 'nullable|integer',
            'category' => 'nullable|string|max:100',
            'part_brand' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $sparePart = \App\Models\SparePart::findOrFail($id);

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($sparePart->image && \Storage::disk('public')->exists($sparePart->image)) {
                Storage::disk('public')->delete($sparePart->image);
            }

            // Yeni resmi kaydet
            $imagePath = $request->file('image')->store('spareparts', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Yeni resim yoksa, eski image bilgisini tekrar ekle
            $validated['image'] = $sparePart->image;
        }

        $sparePart->update($validated);

        return redirect()->route('spare-parts.index')->with('success', 'Yedek parça güncellendi!');
    }

    // Yedek parçayı sil
    public function destroy($id)
    {
        $sparePart = SparePart::findOrFail($id);
        $sparePart->delete();

        return redirect()->route('spare-parts.index')->with('success', 'Yedek parça silindi!');
    }
}
