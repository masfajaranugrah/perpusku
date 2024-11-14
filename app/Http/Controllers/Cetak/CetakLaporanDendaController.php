<?php

namespace App\Http\Controllers\Cetak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fpdf\Fpdf;

class CetakLaporanDendaController extends Controller
{
    public function generatePDF()
    {
        // Membuat instance PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Ambil data instansi
        $instansi = $this->getInstansiData();

     
        $logo_path = public_path('storage/' . $instansi->logo);
        $pdf->Image($logo_path, 100, 10, 10);  

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 30, $instansi->nama, 0, 1, 'C');
        $pdf->Ln(-10);

        // Judul
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 1, 'Laporan Jumlah Total Denda per Bulan/Tahun', 0, 1, 'C');
        $pdf->Ln(10);

        // Tabel
        $this->generateTable($pdf);

        // Output PDF
        $pdf->Output('D', 'laporan_denda.pdf');
    }

    private function generateTable($pdf)
    {
        // Query SQL untuk mengambil jumlah total denda per bulan/tahun
        $data_denda = DB::table('peminjaman')
            ->select(DB::raw("DATE_FORMAT(tanggal_peminjaman, '%Y-%m') AS bulan_peminjaman"), 
                DB::raw("SUM(denda) AS total_denda"), 
                DB::raw("COUNT(DISTINCT id_anggota) AS jumlah_orang_denda"))
            ->groupBy('bulan_peminjaman')
            ->get();
    
        // Inisialisasi variabel untuk menyimpan total
        $total_semua_denda = 0;
        $total_orang_denda = 0;
    
        // Tabel header
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(15, 10, 'No', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Bulan/Tahun', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Total Denda', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Jumlah Orang', 1, 1, 'C');
    
        $pdf->SetFont('Arial', '', 12);
        $no = 1;
    
        foreach ($data_denda as $data) {
            if ($data->total_denda > 0) { // Hanya jika ada denda pada bulan tersebut
                $pdf->Cell(15, 10, $no++, 1, 0, 'C');
                $pdf->Cell(60, 10, $data->bulan_peminjaman, 1, 0, 'C');
                $pdf->Cell(60, 10, 'Rp ' . number_format($data->total_denda, 0, ',', '.'), 1, 0, 'R');
                $pdf->Cell(50, 10, $data->jumlah_orang_denda, 1, 1, 'C');
    
                $total_semua_denda += $data->total_denda;
                $total_orang_denda += $data->jumlah_orang_denda;
            }
        }
    
        // Menampilkan total di bagian akhir
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(75, 10, 'Total', 1, 0, 'R');
        $pdf->Cell(60, 10, 'Rp ' . number_format($total_semua_denda, 0, ',', '.'), 1, 0, 'R');
        $pdf->Cell(50, 10, $total_orang_denda, 1, 1, 'C');
    }
 

    private function getInstansiData()
    {
        return DB::table('instansi')->first(); // Ambil satu baris data instansi
    }
}
