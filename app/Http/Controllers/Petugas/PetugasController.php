<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Pengurus;
use App\Models\Buku;
use App\Models\Aturan_denda;
use App\Models\Peminjaman;
use App\Models\Instansi;
class PetugasController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count(); 
        $totalAdmin = Pengurus::count(); 
        $totalBuku = Buku::sum('jumlah');  
        $instansi = Instansi::first();
        $jumlahKategori = Aturan_denda::distinct('jenis')->count('jenis');  
        $admins = Pengurus::select('nama', 'username')->get();
    
        // Mengambil data peminjaman dengan hubungan
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->get();
    
        $peminjamanData = Peminjaman::selectRaw('MONTH(tanggal_peminjaman) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        return view("Petugas.PetugasDashboard.Dashboard", compact(
            'totalAnggota',
            'totalAdmin',
            'totalBuku',
            'jumlahKategori',
            'admins',
            'peminjaman',
            'peminjamanData',
            'instansi'
        ));
    }
    
}
