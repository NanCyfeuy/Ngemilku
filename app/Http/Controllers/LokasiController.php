<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokasiController extends Controller
{
    // Tampilkan halaman admin
    public function index()
    {
        $lokasi = Lokasi::all();
        return view('admin.index', compact('lokasi'));
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'hotlink' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jam_operasional' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('lokasi', 'public');
        }

        Lokasi::create($validated);

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id_tempat)
{
    $lokasi = Lokasi::findOrFail($id_tempat);

    $validated = $request->validate([
        'nama' => 'required|string|max:100',
        'alamat' => 'required|string|max:100',
        'deskripsi' => 'nullable|string',
        'longitude' => 'required|numeric',
        'latitude' => 'required|numeric',
        'hotlink' => 'nullable|string|max:255',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'jam_operasional' => 'nullable|string|max:100',
    ]);

    if ($request->hasFile('gambar')) {
        if ($lokasi->gambar) {
            Storage::disk('public')->delete($lokasi->gambar);
        }
        $validated['gambar'] = $request->file('gambar')->store('lokasi', 'public');
    }

    $lokasi->update($validated);

    return redirect()->route('admin.index')->with('success', 'Lokasi berhasil diperbarui!');
}

public function destroy($id_tempat)
{
    $lokasi = Lokasi::findOrFail($id_tempat);

    if ($lokasi->gambar) {
        Storage::disk('public')->delete($lokasi->gambar);
    }

    $lokasi->delete();

    return redirect()->route('admin.index')->with('success', 'Lokasi berhasil dihapus!');
}

}
