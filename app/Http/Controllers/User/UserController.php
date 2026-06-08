<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Booking;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function home(Request $request)
    {
        $rekomendasi = Kendaraan::where('status', 'Tersedia')
            ->orderBy('total_dipesan', 'desc')
            ->take(3)
            ->get();
        return view('user.home', compact('rekomendasi'));
    }

    public function kategori(Request $request, $kategori)
    {
        $query = Kendaraan::where('status', 'Tersedia')
            ->where('jenis', ucfirst($kategori));

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $kendaraan = $query->get();
        return view('user.kategori', compact('kendaraan', 'kategori'));
    }

    public function detail($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('user.detail', compact('kendaraan'));
    }

    public function booking()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('kendaraan')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.booking', compact('bookings'));
    }

    public function createBooking(Request $request)
    {
        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);
        $paket = $request->paket ?? 1;
        $total_harga = $kendaraan->harga_sewa * $paket;

        session([
            'kendaraan_id' => $kendaraan->id,
            'paket' => $paket,
            'total_harga' => $total_harga,
            'harga_sewa' => $kendaraan->harga_sewa
        ]);

        return view('user.booking-data');
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_ktp' => 'required',
            'no_sim' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'tanggal_pemakaian' => 'required|date',
            'jaminan' => 'required'
        ]);

        $kendaraan_id = $request->kendaraan_id;
        $paket = (int) $request->paket;
        $total_harga = $request->total_harga;

        $data = [
            'user_id' => auth()->id(),
            'kendaraan_id' => $kendaraan_id,
            'tanggal_mulai' => $request->tanggal_pemakaian,
            'tanggal_selesai' => Carbon::parse($request->tanggal_pemakaian)->addDays($paket),
            'total_harga' => $total_harga,
            'status' => 'pending',
            'nama' => $request->nama,
            'no_ktp' => $request->no_ktp,
            'no_sim' => $request->no_sim,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jaminan' => $request->jaminan,
            'status_penyewa' => 'Ready',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('bookings')->insert($data);

        // redirect ke payment
        return redirect()->route('user.payment');
    }

    public function riwayat()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('kendaraan')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.riwayat', compact('bookings'));
    }

    public function bantuan()
    {
        return view('user.bantuan');
    }

    public function storeBantuan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_wa' => 'required',
            'deskripsi' => 'required',
        ]);

        Laporan::create([
            'user_id' => auth()->id(),
            'no_wa' => $request->no_wa,
            'deskripsi' => $request->deskripsi,
            'foto_bukti' => $request->hasFile('bukti') ? $request->file('bukti')->store('laporan', 'public') : null,
            'status' => 'Belum Ditangani'
        ]);

        return redirect()->route('user.bantuan')->with('success', 'Laporan berhasil dikirim');
    }

    public function riwayatBantuan()
    {
        $laporans = Laporan::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.riwayat-bantuan', compact('laporans'));
    }

    public function profil()
    {
        $user = auth()->user();
        return view('user.profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required',
            'current_password' => 'nullable|min:8',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->alamat = $request->alamat;

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('user.profil')->with('success', 'Profil berhasil diperbarui');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = auth()->user();

        if ($user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        $path = $request->file('photo')->store('profil', 'public');
        $user->foto_profil = $path;
        $user->save();

        return redirect()->route('user.profil')->with('success', 'Foto profil berhasil diperbarui');
    }
}