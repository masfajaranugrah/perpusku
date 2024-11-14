<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class DendaController extends Controller
{
    //index
    public function index(){       
         $instansi = Instansi::first(); // You can use `first()` to get a single record


         $data_denda = Peminjaman::select(DB::raw("DATE_FORMAT(tanggal_peminjaman, '%Y-%m') AS bulan_peminjaman"), 
         DB::raw("SUM(denda) AS total_denda"), 
         DB::raw("COUNT(DISTINCT id_anggota) AS jumlah_orang_denda"))
         ->where('denda', '>', 0)
         ->groupBy(DB::raw("DATE_FORMAT(tanggal_peminjaman, '%Y-%m')"))
         ->get();

     // Initialize variables to store totals
     $total_semua_denda = 0;
     $total_orang_denda = 0;

     // Process data for totals
     foreach ($data_denda as $row) {
         $total_semua_denda += $row->total_denda;
         $total_orang_denda += $row->jumlah_orang_denda;
     }


     $data_anggota_denda = DB::table('peminjaman')
     ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id_anggota')
     ->select('anggota.id_anggota', 'anggota.nama as nama_anggota', 'anggota.angkatan',
         DB::raw('COUNT(peminjaman.id_anggota) as total_denda'),
         DB::raw('SUM(peminjaman.denda) as total_uang_denda'))
     ->where('peminjaman.denda', '>', 0)
     ->groupBy('anggota.id_anggota')
     ->orderBy('total_denda', 'DESC')
     ->get();

        return view("Admin.Components.denda", [
            'instansi' => $instansi,
            'data_denda' => $data_denda,
            'total_semua_denda' => $total_semua_denda,
            'total_orang_denda' => $total_orang_denda,
            'data_anggota_denda' => $data_anggota_denda
        ]);
    }
}
