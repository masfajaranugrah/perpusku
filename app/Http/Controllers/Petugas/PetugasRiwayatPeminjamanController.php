<?php

namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\Peminjaman;

class PetugasRiwayatPeminjamanController extends Controller
{
   //index
   public function index(){
    $instansi = Instansi::first(); // You can use `first()` to get a single record
    $peminjaman = Peminjaman::with(['buku', 'anggota'])->get();

    return view("Petugas.Components.riwayat-peminjaman-all", compact('instansi','peminjaman'));
}

public function destroy(Request $request)
{
    // Ambil ID peminjaman yang dikirim dari form
    $peminjamanIds = $request->input('hapus');

    // Pastikan ada ID yang diterima
    if (!empty($peminjamanIds)) {
        // Hapus data peminjaman yang sesuai dengan ID yang dipilih
        Peminjaman::whereIn('id_peminjaman', $peminjamanIds)->delete();

        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus.');
    }

    return redirect()->back()->with('error', 'Tidak ada data yang dipilih untuk dihapus.');
}
}
