<?php

namespace App\Http\Controllers\Cetak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fpdf\Fpdf;

class CetakPeminjamanController extends Controller
{
    public function generateReport(Request $request)
    {
        // Ambil id peminjaman yang dipilih dari request
        $peminjaman_ids = $request->input('peminjaman_ids', []);

        // Query untuk mendapatkan data peminjaman berdasarkan id yang dipilih
        $data_peminjaman = DB::table('peminjaman')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->join('anggota', 'peminjaman.id_anggota', '=', 'anggota.id_anggota')
            ->whereIn('peminjaman.id_peminjaman', $peminjaman_ids)
            ->select(
                'peminjaman.*',
                'buku.id_buku',
                'buku.kode_buku',
                'anggota.nama',
                'anggota.angkatan'
            )
            ->get();

        // Ambil data instansi
        $instansi = DB::table('instansi')->first();

        // Buat instance FPDF baru (Landscape, A4)
        $pdf = new Fpdf('L', 'mm', 'A4');
        $pdf->AddPage();

        // Menampilkan logo (cek jika logo ada)
        if (!empty($instansi->logo)) {
            $logo_path = public_path('storage/' . $instansi->logo);
            if (file_exists($logo_path)) {
                $logo_width = 30; // Lebar logo
                $page_width = 297; // Lebar halaman A4 dalam mode landscape
                $center_x = ($page_width - $logo_width) / 2; // Posisi X untuk logo di tengah
                $pdf->Image($logo_path, $center_x, 10, $logo_width);
            }
        }

        // Menampilkan nama instansi
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Ln(20); // Beri jarak setelah logo
        $pdf->Cell(0, 10, strtoupper($instansi->nama), 0, 1, 'C');

        // Judul laporan
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Laporan Peminjaman Buku', 0, 1, 'C');

        // Header tabel
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(15, 10, 'No', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'ID Buku', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Kode Buku', 1, 0, 'C', true);
        $pdf->Cell(60, 10, 'Nama Anggota', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Angkatan', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Tanggal Peminjaman', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Tanggal Pengembalian', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Denda', 1, 1, 'C', true);

        // Isi tabel
        $pdf->SetFont('Arial', '', 10);
        if ($data_peminjaman->isEmpty()) {
            // Jika tidak ada data
            $pdf->Cell(0, 10, 'Tidak ada data peminjaman yang dipilih.', 1, 1, 'C');
        } else {
            $no = 1;
            foreach ($data_peminjaman as $row) {
                $pdf->Cell(15, 10, $no++, 1, 0, 'C');
                $pdf->Cell(30, 10, $row->id_buku ?? '-', 1, 0, 'C');
                $pdf->Cell(35, 10, $row->kode_buku ?? '-', 1, 0, 'L');
                $pdf->Cell(60, 10, $row->nama ?? '-', 1, 0, 'L');
                $pdf->Cell(30, 10, $row->angkatan ?? '-', 1, 0, 'C');
                $pdf->Cell(40, 10, $row->tanggal_peminjaman ?? '-', 1, 0, 'C');
                $pdf->Cell(40, 10, $row->tanggal_pengembalian ?? 'Belum dikembalikan', 1, 0, 'C');
                $pdf->Cell(30, 10, 'Rp ' . number_format($row->denda, 0, ',', '.'), 1, 1, 'C');
            }
        }

        // Output PDF
        $pdf->Output();
        exit;
    }
}
