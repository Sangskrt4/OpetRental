<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kendaraan::query();

        // TAMBAHKAN INI 👇 (Filter berdasarkan jenis)
        if ($request->has('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        $kendaraan = $query->get();
        return view('admin.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_plat' => 'required|unique:kendaraan',
            'harga_sewa' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kendaraan', 'public');
        }

        Kendaraan::create($data);
        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'no_plat' => 'required|unique:kendaraan,no_plat,' . $id,
            'harga_sewa' => 'required|numeric',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($kendaraan->gambar) {
                Storage::disk('public')->delete($kendaraan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kendaraan', 'public');
        }

        $kendaraan->update($data);
        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil diupdate');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        if ($kendaraan->gambar) {
            Storage::disk('public')->delete($kendaraan->gambar);
        }

        $kendaraan->delete();
        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil dihapus');
    }
}