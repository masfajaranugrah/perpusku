<?php

 
namespace App\Http\Controllers\Cetak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fpdf\Fpdf;
use Illuminate\Support\Facades\Storage;

class CetakPeminjamanController extends Controller
{
    public function generateReport(Request $request)
    {
        // Ambil id peminjaman yang dipilih dari request
        $peminjaman_ids = $request->input('peminjaman_ids', []);

        // Query to get the peminjaman data based on selected ids
        $data_peminjaman = DB::table('peminjaman')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id_anggota')
            ->whereIn('peminjaman.id_peminjaman', $peminjaman_ids)
            ->select('peminjaman.*', 'buku.id_buku', 'anggota.nama', 'anggota.angkatan')
            ->get();
        
        // Fetch instansi data
        $instansi = DB::table('instansi')->first();

        // Create a new FPDF instance (Landscape, A4)
        $pdf = new Fpdf('L', 'mm', 'A4');
        $pdf->AddPage();
        
 // Menghitung posisi tengah untuk logo
 $logo_path = public_path('storage/' . $instansi->logo);
 $logo_width = 15; // Ukuran lebar logo (atur sesuai kebutuhan)
 $page_width = 297; // Lebar halaman A4 dalam mode landscape
 $center_x = ($page_width - $logo_width) / 2; // Hitung posisi X untuk menempatkan logo di tengah

 // Menampilkan logo di posisi tengah
 $pdf->Image($logo_path, $center_x, 10, $logo_width); 
        
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 30, $instansi->nama, 0, 1, 'C');
        $pdf->Ln(-14);

        // Report title
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Laporan Peminjaman Buku', 0, 1, 'C');

        // Table header
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(15, 10, 'No', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'ID Buku', 1, 0, 'C', true);
        $pdf->Cell(70, 10, 'Nama', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Angkatan', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Peminjaman', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Pengembalian', 1, 0, 'C', true);
        $pdf->Cell(45, 10, 'Denda', 1, 1, 'C', true);

        // Table content
        if ($data_peminjaman->isEmpty()) {
            // If no data available, add a message to the PDF
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Cell(0, 10, 'Tidak ada data peminjaman yang dipilih.', 0, 1, 'C');
        } else {
            $no = 1;
            foreach ($data_peminjaman as $row) {
                $pdf->Cell(15, 10, $no++, 1, 0, 'C');
                $pdf->Cell(25, 10, $row->id_buku, 1, 0, 'C');
                $pdf->Cell(70, 10, $row->nama, 1, 0, 'L');
                $pdf->Cell(30, 10, $row->angkatan, 1, 0, 'C');
                $pdf->Cell(35, 10, $row->tanggal_peminjaman, 1, 0, 'C');
                $pdf->Cell(35, 10, $row->tanggal_pengembalian ? utf8_decode($row->tanggal_pengembalian) : 'Belum dikembalikan', 1, 0, 'C');
                $pdf->Cell(45, 10, 'Rp ' . number_format($row->denda, 0, ',', '.'), 1, 1, 'C');
            }
        }

        // Output the PDF
        $pdf->Output();
        exit;
    }
}

