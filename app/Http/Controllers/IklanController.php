<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iklan;

class IklanController extends Controller
{
    public function index()
    {
        $iklans = Iklan::paginate(10);
        return view('app.iklan.index', compact('iklans'));
    }

    public function create()
    {
        return view('app.iklan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required',
            'position' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,|max:2048',
        ]);

            $IklanPath = null;
            if ($request->hasFile('image')) {
            $IklanPath = $request->file('image')->store('iklan', 'public');
        }
        

        Iklan::create([
            'name' => $request->name,
            'content' => $request->content,
            'position' => $request->position,
            'is_active' => $request->is_active ?? false,
            'image' => $IklanPath,
        ]);

        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil ditambahkan.');
    }

    public function show(Iklan $iklan)
    {
        return view('app.iklan.show', compact('iklan'));
    }

    public function edit(Iklan $iklan)
    {
        return view('app.iklan.edit', compact('iklan'));
    }

    public function update(Request $request, Iklan $iklan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required',
            'position' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $iklan->name = $request->name;
        $iklan->content = $request->content;
        $iklan->position = $request->position;
        $iklan->is_active = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($iklan->image && file_exists(storage_path('app/public/'.$iklan->image))) {
                unlink(storage_path('app/public/'.$iklan->image));
            }

            $path = $request->file('image')->store('iklan', 'public');
            $iklan->image = $path;
        }

        $iklan->save();

        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil diperbarui.');
    }

    public function destroy(Iklan $iklan)
    {
        if ($iklan->image && file_exists(storage_path('app/public/iklan'.$iklan->image))) {
            unlink(storage_path('app/public/iklan'.$iklan->image));
        }

        $iklan->delete();

        return redirect()->route('iklan.index')->with('success', 'Iklan berhasil dihapus.');
    }
    public function deactivate(Iklan $iklan)
    {
        $iklan->update(['is_active' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Iklan berhasil dinonaktifkan.'
        ]);
    }
}