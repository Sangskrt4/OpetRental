<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'status' => $request->status
        ]);
        return redirect()->route('admin.laporan.index')->with('success', 'Status laporan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        if ($laporan->foto_bukti) {
            Storage::disk('public')->delete($laporan->foto_bukti);
        }
        $laporan->delete();
        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}