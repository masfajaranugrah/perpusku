<?php

namespace App\Http\Controllers\Cetak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Instansi;
use FPDF;
class CetakLaporanDendaAnggotaController extends Controller
{
    public function generatePdf()
    {
        // Fungsi untuk mengambil nama bulan dalam bahasa Indonesia
        function getNamaBulan($bulan) {
            $nama_bulan = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            ];
            return $nama_bulan[$bulan];
        }

        // Ambil data peminjaman dan hitung total denda per anggota
        $data_anggota_denda = Peminjaman::selectRaw('anggota.id_anggota, anggota.nama as nama_anggota, anggota.angkatan, COUNT(peminjaman.id_anggota) as total_denda, SUM(peminjaman.denda) as total_uang_denda')
            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id_anggota')
            ->where('peminjaman.denda', '>', 0)
            ->groupBy('anggota.id_anggota')
            ->orderBy('total_denda', 'DESC')
            ->get();

        // Ambil data instansi
        $instansi = Instansi::first();

        // Inisialisasi PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        $logo_path = public_path('storage/' . $instansi->logo);
        $pdf->Image($logo_path, 100, 10, 10); 

        // Header PDF
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0, 30, $instansi->nama, 0, 1, 'C');
        $pdf->Ln(-10);

        // Judul laporan
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 1, 'Laporan Daftar Anggota dengan Total Denda', 0, 1, 'C');
        $pdf->Ln(10);

        // Tabel
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C');
        $pdf->Cell(30, 10, 'ID Anggota', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Nama Anggota', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Angkatan', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Total Denda', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Total Uang', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 11);
        $no = 1;

        // Isi tabel dengan data anggota
        foreach ($data_anggota_denda as $anggota) {
            $pdf->Cell(10, 10, $no++, 1, 0, 'C');
            $pdf->Cell(30, 10, $anggota->id_anggota, 1, 0, 'C');
            $pdf->Cell(60, 10, $anggota->nama_anggota, 1, 0, 'C');
            $pdf->Cell(30, 10, $anggota->angkatan, 1, 0, 'C');
            $pdf->Cell(30, 10, $anggota->total_denda, 1, 0, 'C');
            $pdf->Cell(30, 10, 'Rp ' . number_format($anggota->total_uang_denda, 0, ',', '.'), 1, 1, 'R');
        }

        // Output PDF
        $pdf->Output();
        exit;
    }
 
}
