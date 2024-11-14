<?php

namespace App\Http\Controllers\Cetak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fpdf\Fpdf;


class CetakJumlahBukuController extends Controller
{
       // Function to generate the PDF report
       public function generateReport()
       {
           // Query to fetch monthly borrowing data
           $data_peminjaman = DB::table('peminjaman')
               ->select(DB::raw("DATE_FORMAT(tanggal_peminjaman, '%Y-%m') AS bulan_peminjaman"), DB::raw("COUNT(*) AS total_peminjaman"))
               ->groupBy('bulan_peminjaman')
               ->get();
   
           // Initialize an array to store data per month
           $data_per_bulan = [];
   
           // Process the data fetched
           foreach ($data_peminjaman as $row) {
               $data_per_bulan[$row->bulan_peminjaman] = $row->total_peminjaman;
           }
   
           // Create a new PDF instance
           $pdf = new Fpdf();
           $pdf->AddPage();
   
           // Get institution data
           $instansi = DB::table('instansi')->first();
   
           $logo_path = public_path('storage/' . $instansi->logo);
           $pdf->Image($logo_path, 100, 10, 10); 
           // Set font and add institution name
           $pdf->SetFont('Arial', 'B', 12);
           $pdf->Cell(0, 30, $instansi->nama ?? 'Nama Instansi', 0, 1, 'C');
           $pdf->Ln(-10);
   
           // Title
           $pdf->SetFont('Arial', 'B', 12);
           $pdf->Cell(0, 10, 'Laporan Jumlah Peminjaman Buku per Bulan', 0, 1, 'C');
           $pdf->Ln(10);
   
           // Table header
           $pdf->SetFont('Arial', 'B', 12);
           $pdf->Cell(15, 10, 'No', 1, 0, 'C'); // Add serial number column
           $pdf->Cell(70, 10, 'Bulan Peminjaman', 1, 0, 'C');
           $pdf->Cell(70, 10, 'Total Peminjaman Buku', 1, 1, 'C');
   
           // Table content
           $pdf->SetFont('Arial', '', 12);
           $no = 1; // Initialize serial number
           foreach ($data_per_bulan as $bulan => $total_peminjaman) {
               $pdf->Cell(15, 10, $no, 1, 0, 'C'); // Display serial number
               $pdf->Cell(70, 10, $this->getNamaBulan(substr($bulan, 5)) . ' ' . substr($bulan, 0, 4), 1, 0, 'C'); // Format month and year
               $pdf->Cell(70, 10, $total_peminjaman, 1, 1, 'C');
               $no++; // Increment serial number
           }
   
           // Center the table vertically
           $pdf->SetY(($pdf->GetPageHeight() - $pdf->GetY()) / 2 - 5); // Vertical position at half page height
   
           // Output the PDF
           $pdf->Output();
           exit; // Ensure no further output is sent
       }
   
       // Function to get month name in Indonesian
       private function getNamaBulan($bulan)
       {
           $nama_bulan = array(
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
               '12' => 'Desember'
           );
           return $nama_bulan[$bulan] ?? 'Unknown'; // Return 'Unknown' if month not found
       }
}
