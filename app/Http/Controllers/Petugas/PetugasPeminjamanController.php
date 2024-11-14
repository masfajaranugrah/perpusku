<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Instansi;

class PetugasPeminjamanController extends Controller
{
       // Display the initial form and today's loans
   public function index()
   {
       // Get today's date
       $tanggal = date('Y-m-d');
       $instansi = Instansi::first(); // You can use `first()` to get a single record
       $anggota = Anggota::all(); // You can use `first()` to get a single record

       // Fetch today's loans with related member and book data
       $peminjamans = Peminjaman::with(['anggota', 'buku'])
           ->whereDate('tanggal_peminjaman', $tanggal)
           ->get();

       return view('Petugas.Components.peminjaman', compact('peminjamans', 'tanggal', 'instansi', 'anggota'));
   }
// Process the member ID input and redirect
public function checkAnggota(Request $request)
{
    // Validate the input
    $request->validate([
        'id_anggota' => 'required'
    ]);

    $idAnggota = $request->input('id_anggota');

    // Check if the member exists
    $anggota = Anggota::where('id_anggota', $idAnggota)->first();

    if ($anggota) {
        // Redirect to the loan creation page with the member ID and additional parameters
        return redirect()->route('petugaspeminjaman.create', [
            'id_anggota' => $idAnggota,
            'source' => 'website',
            'referral' => 'anggota'
        ]);
    } else {
        // Redirect back with an error message
        return redirect()->back()->with('error_message', 'ID Anggota tidak terdaftar');
    }
}


   // Display the loan creation page
 public function create($id_anggota, Request $request)
{
    // Fetch the member data
    $anggota = Anggota::where('id_anggota', $id_anggota)->first();
    $instansi = Instansi::first(); // You can use `first()` to get a single record
    $buku = Buku::all(); // You can use `first()` to get a single record

    if (!$anggota) {
        // Redirect back if member not found
        return redirect()->route('peminjaman.index')->with('error_message', 'ID Anggota tidak ditemukan');
    }

    // Ambil parameter dari query string
    $source = $request->query('source', ''); // default to empty string if not found
    $referral = $request->query('referral', '');

    return view('Petugas.Components.buat-pinjaman', compact('anggota', 'source', 'referral', 'instansi', 'buku'));
}


   // Check if a book exists (AJAX request)
   public function checkBook(Request $request)
   {
       $idBuku = $request->input('id_buku');

       // Fetch the book data
       $buku = Buku::where('id_buku', $idBuku)->first();

       if ($buku) {
           return response()->json([
               'status' => 'found',
               'id_buku' => $buku->id_buku,
               'judul' => $buku->judul,
           ]);
       } else {
          
           dd('tidak ada');
       }
   }

   // Save the loan data
   public function store(Request $request)
   {
       $idAnggota = $request->input('id_anggota');
       $idBukuList = $request->input('id_buku'); 

       // Validate input
       if (!$idAnggota || empty($idBukuList)) {
 
        return redirect()->route('petugaspeminjaman')->with('error', 'ID anggota dan ID Buku tidak di temukan. Silahkan Coba  lagi');
       }

       // Check if member exists
       $anggota = Anggota::where('id_anggota', $idAnggota)->first();
       if (!$anggota) {
        return redirect()->route('petugaspeminjaman.create')->with('gagal', 'ID anggota tidak di temukan.');
    }

       // Save each loan record
       foreach ($idBukuList as $idBuku) {
           $buku = Buku::where('id_buku', $idBuku)->first();
           if ($buku) {
               Peminjaman::create([
                   'id_anggota' => $idAnggota,
                   'id_buku' => $idBuku,
                   'tanggal_peminjaman' => now(),
                   // Add other fields if necessary

                   
               ]);

                return redirect()->route('petugaspeminjaman')->with('success', 'Data jenis  berhasil tambahkan.');

           } else {
               // Handle the case where the book is not found
               continue;
           }
       }

    }
}
