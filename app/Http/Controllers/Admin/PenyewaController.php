<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    public function index()
    {
        $penyewa = Booking::select('id', 'nama', 'no_hp', 'alamat', 'no_sim', 'jaminan', 'status_penyewa')
            ->groupBy('id', 'nama', 'no_hp', 'alamat', 'no_sim', 'jaminan', 'status_penyewa')
            ->get();
        return view('admin.penyewa.index', compact('penyewa'));
    }

    public function create()
    {
        return view('admin.penyewa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'jaminan' => 'required'
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'kendaraan_id' => 1,
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addDay(),
            'total_harga' => 0,
            'status' => 'selesai',
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'no_sim' => $request->no_sim ?? '-',
            'jaminan' => $request->jaminan,
            'status_penyewa' => 'Ready'
        ]);

        return redirect()->route('admin.penyewa.index')->with('success', 'Penyewa berhasil ditambahkan');
    }

    public function show($id)
    {
        $penyewa = Booking::findOrFail($id);
        return view('admin.penyewa.show', compact('penyewa'));
    }

    public function edit($id)
    {
        $penyewa = Booking::findOrFail($id);
        return view('admin.penyewa.edit', compact('penyewa'));
    }

    public function update(Request $request, $id)
    {
        $penyewa = Booking::findOrFail($id);
        $penyewa->update([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'no_sim' => $request->no_sim,
            'jaminan' => $request->jaminan,
            'status_penyewa' => $request->status_penyewa
        ]);
        return redirect()->route('admin.penyewa.index')->with('success', 'Penyewa berhasil diupdate');
    }

    public function destroy($id)
    {
        $penyewa = Booking::findOrFail($id);
        $penyewa->delete();
        return redirect()->route('admin.penyewa.index')->with('success', 'Penyewa berhasil dihapus');
    }
}