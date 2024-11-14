<?php

namespace App\Http\Controllers\Cetak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fpdf\Fpdf;
class CetakLaporanRataController extends Controller
{
    public function generateReport()
    {
        // Query to fetch peminjaman and buku data
        $data_peminjaman = DB::table('peminjaman')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->select('buku.jenis', DB::raw('DATEDIFF(peminjaman.tanggal_pengembalian, peminjaman.tanggal_peminjaman) AS durasi_peminjaman'))
            ->whereNotNull('peminjaman.tanggal_pengembalian') // Only consider returned books
            ->get();

        // Calculate the total duration and count of books per type (jenis)
        $jenis_durasi = [];
        $jenis_jumlah = [];

        foreach ($data_peminjaman as $row) {
            $jenis = $row->jenis;
            $durasi_peminjaman = $row->durasi_peminjaman;

            // Initialize if not set
            if (!isset($jenis_durasi[$jenis])) {
                $jenis_durasi[$jenis] = 0;
                $jenis_jumlah[$jenis] = 0;
            }

            $jenis_durasi[$jenis] += $durasi_peminjaman;
            $jenis_jumlah[$jenis]++;
        }

        // Calculate the average borrowing duration per book type
        $jenis_rata_rata = [];
        foreach ($jenis_durasi as $jenis => $total_durasi) {
            $jumlah_buku = $jenis_jumlah[$jenis];
            $rata_rata = ($jumlah_buku > 0) ? $total_durasi / $jumlah_buku : 0;
            $jenis_rata_rata[$jenis] = round($rata_rata, 2);
        }

        // Get instansi data
        $instansi = DB::table('instansi')->first();

        // Create a new FPDF instance (Portrait, A4)
        $pdf = new Fpdf();
        $pdf->AddPage();

        $logo_path = public_path('storage/' . $instansi->logo);
        $pdf->Image($logo_path, 100, 10, 10); 

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 30, $instansi->nama ?? 'Nama Instansi', 0, 1, 'C');
        $pdf->Ln(-10);

        // Report title
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Laporan Rata-rata Durasi Peminjaman Buku Berdasarkan Jenis', 0, 1, 'C');
        $pdf->Ln(10);

        // Table header
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(90, 10, 'Jenis Buku', 1, 0, 'C');
        $pdf->Cell(90, 10, 'Rata-rata Durasi (hari)', 1, 1, 'C');

        // Table content
        $pdf->SetFont('Arial', '', 12);
        $no = 1;
        foreach ($jenis_rata_rata as $jenis => $rata_rata) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(90, 10, $jenis, 1, 0, 'C');
            $pdf->Cell(90, 10, $rata_rata, 1, 1, 'C');
        }

        // Output the PDF
        $pdf->Output();
        exit;
    }

}
