<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Instansi;
use Illuminate\Support\Facades\DB;

class RiwayatBukuController extends Controller
{
         //index
         public function index(){
            $instansi = Instansi::first();

       // Proses perhitungan rata-rata seperti yang sebelumnya
       $peminjamanData = DB::table('peminjaman')
       ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
       ->select(
           'buku.jenis',
           DB::raw('DATEDIFF(peminjaman.tanggal_pengembalian, peminjaman.tanggal_peminjaman) as durasi_peminjaman')
       )
       ->whereNotNull('peminjaman.tanggal_pengembalian')
       ->get();

   $jenisDurasi = [];
   $jenisJumlah = [];

   foreach ($peminjamanData as $data) {
       $jenis = $data->jenis;
       $durasiPeminjaman = $data->durasi_peminjaman;

       if (!isset($jenisDurasi[$jenis])) {
           $jenisDurasi[$jenis] = 0;
           $jenisJumlah[$jenis] = 0;
       }
       $jenisDurasi[$jenis] += $durasiPeminjaman;
       $jenisJumlah[$jenis]++;
   }

   $jenisRataRata = [];
   foreach ($jenisDurasi as $jenis => $totalDurasi) {
       $jumlahBuku = $jenisJumlah[$jenis];
       $rataRata = ($jumlahBuku > 0) ? $totalDurasi / $jumlahBuku : 0;
       $jenisRataRata[$jenis] = round($rataRata, 2);
   }
 
   $data_per_bulan = Peminjaman::selectRaw("DATE_FORMAT(tanggal_peminjaman, '%Y-%m') AS bulan_peminjaman, COUNT(*) AS total_peminjaman")
   ->groupBy('bulan_peminjaman')
   ->get();


   $datariwayat = Peminjaman::select('buku.judul', \DB::raw('COUNT(*) AS total_peminjaman'))
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->groupBy('buku.judul')
            ->orderBy('total_peminjaman', 'DESC')
            ->get();
            return view("Admin.Components.riwayat-buku", compact('instansi', 'jenisRataRata', 'data_per_bulan', 'datariwayat'));
        }
}
