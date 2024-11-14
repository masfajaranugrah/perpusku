<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Buku; 
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    // Index method to show the return page
    public function index()
    {
        $instansi = Instansi::first();
        $anggota = Anggota::all();

        // Retrieve unreturned loans that have passed the deadline
        $peminjaman = DB::table('peminjaman')
            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id_anggota')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->leftJoin('aturan_denda', 'buku.jenis', '=', 'aturan_denda.jenis')
            ->select('anggota.nama', 'peminjaman.tanggal_peminjaman', 'aturan_denda.biaya_per_hari', 'aturan_denda.hari_terlambat')
            ->whereNull('peminjaman.tanggal_pengembalian')
            ->where(DB::raw('DATEDIFF(CURRENT_DATE(), peminjaman.tanggal_peminjaman)'), '>', DB::raw('aturan_denda.hari_terlambat'))
            ->get();

        return view('Admin.Components.pengembalian', compact('peminjaman', 'instansi', 'anggota'));
    }

    // Process the member ID input and redirect
    public function checkAnggota(Request $request)
    {
        // Validate the input
        $request->validate([
            'id_anggota' => 'required|exists:anggota,id_anggota'
        ]);

        $idAnggota = $request->input('id_anggota');

        // Redirect to the loan creation page with the member ID
        return redirect()->route('pengembalian.create', [
            'id_anggota' => $idAnggota
        ]);
    }

    // Create the return entry for a member
    public function create($id_anggota, Request $request)
{
    $instansi = Instansi::first();
    $anggota = Anggota::findOrFail($id_anggota);
    
    // Fetch borrowing records for the specific member
    $peminjaman = DB::table('peminjaman')
        ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id_anggota')
        ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
        ->leftJoin('aturan_denda', 'buku.jenis', '=', 'aturan_denda.jenis')
        ->select(
            'anggota.nama',
            'peminjaman.tanggal_peminjaman',
            'peminjaman.id_peminjaman',
            'aturan_denda.biaya_per_hari',
            'buku.kode_buku',
            'buku.judul',
            'buku.jenis',
            'aturan_denda.hari_terlambat'
        )
        ->where('peminjaman.id_anggota', $id_anggota) // Filter by member ID
        ->whereNull('peminjaman.tanggal_pengembalian') // Only get non-returned items
        ->get();

    // Calculate penalties
    foreach ($peminjaman as $pinjam) {
        $tanggalPeminjaman = new \DateTime($pinjam->tanggal_peminjaman);
        $tanggalSekarang = new \DateTime();
        $hariTerlambat = max(0, $tanggalSekarang->diff($tanggalPeminjaman)->days - $pinjam->hari_terlambat);

        // Calculate the fine
        $denda = $hariTerlambat * ($pinjam->biaya_per_hari ?? 0);

        // Store the calculated fine in the object
        $pinjam->denda = $denda;
    }

    // Pass the data to the view
    return view('admin.Components.buat-pengembalian', compact('peminjaman', 'anggota', 'instansi'));
}


    public function update(Request $request, $id_peminjaman)
    {
        // Validasi input yang masuk
        $validatedData = $request->validate([
            'id_peminjaman' => 'required|integer',
            'denda' => 'required|numeric|min:0', // Tetap string untuk validasi awal
        ]);
        
        // Cari data peminjaman berdasarkan ID
        $pengembalian = Peminjaman::findOrFail($id_peminjaman);
    
        // Update nilai denda (misal denda di-update oleh sistem)
        $pengembalian->denda = $validatedData['denda'];
        
        // Set tanggal dan waktu pengembalian saat ini
        $pengembalian->tanggal_pengembalian = now(); // Atur tanggal dan waktu saat ini
        
        // Simpan perubahan
        $pengembalian->save();
        
        // Redirect atau berikan respon
        return redirect()->route('pengembalian')->with('success', 'Data pengembalian berhasil diperbarui.');
    }
    
  
    
    
    
   
}
