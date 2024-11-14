<?php

namespace App\Http\Controllers\Cetak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fpdf\Fpdf;

class CetakRataJenisController extends Controller
{
    public function generateReport()
    {
        // Query to fetch total borrowing data by book title
        $data_peminjaman = DB::table('peminjaman')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id_buku')
            ->select('buku.judul', DB::raw('COUNT(*) AS total_peminjaman'))
            ->groupBy('buku.judul')
            ->orderBy('total_peminjaman', 'DESC')
            ->get();

        // Initialize an array to store data
        $data = $data_peminjaman->toArray();

        // Create a new PDF instance
        $pdf = new Fpdf();
        $pdf->AddPage();

        // Get institution data
        $instansi = $this->getInstansiData();
        $logo_path = public_path('storage/' . $instansi->logo);
        $pdf->Image($logo_path, 100, 10, 10); 

        // Set font and add institution name
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 30, $instansi->nama ?? 'Nama Instansi', 0, 1, 'C');
        $pdf->Ln(-10);

        // Title
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Laporan Jumlah Total Peminjaman Buku', 0, 1, 'C');
        $pdf->Ln(10);

        // Table header
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(15, 10, 'No', 1, 0, 'C');
        $pdf->Cell(100, 10, 'Judul Buku', 1, 0, 'C');
        $pdf->Cell(75, 10, 'Jumlah Total Peminjaman', 1, 1, 'C');

        // Table content
        $pdf->SetFont('Arial', '', 12);
        $no = 1; // Initialize serial number
        foreach ($data as $row) {
            $pdf->Cell(15, 10, $no, 1, 0, 'C'); // Display serial number
            $pdf->Cell(100, 10, $row->judul, 1, 0, 'L');
            $pdf->Cell(75, 10, $row->total_peminjaman, 1, 1, 'C');
            $no++; // Increment serial number
        }

        // Output the PDF
        $pdf->Output();
        exit; // Ensure no further output is sent
    }

    // Function to get institution data
    private function getInstansiData()
    {
        return DB::table('instansi')->first(); // Fetch the first row from the instansi table
    }
}
