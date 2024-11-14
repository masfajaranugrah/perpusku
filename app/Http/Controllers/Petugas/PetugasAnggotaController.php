<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Validator;

class PetugasAnggotaController extends Controller
{
 //index
 public function index(){
    $instansi = Instansi::first(); // You can use `first()` to get a single record
    $anggota = Anggota::all();
    return view("Petugas.Components.anggota", compact('instansi', 'anggota'));
}

 // Method to store the anggota data
 public function store(Request $request)
 {
     // Validate the incoming request data
     $request->validate([
         'nama' => 'required|string|max:100',
         'email' => 'required|string|email|max:100|unique:anggota',
         'telepon' => 'required|string|max:15',
         'angkatan' => 'required|string|max:50', // Adjust validation as needed
         'alamat' => 'nullable|string|max:255',
     ]);

     // Create a new Anggota instance
     $anggota = new Anggota();

     // Generate a random 5-digit ID
     $anggota->id_anggota = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
     $anggota->nama = $request->nama;
     $anggota->email = $request->email;
     $anggota->telepon = $request->telepon;
     $anggota->angkatan = $request->angkatan;
     $anggota->alamat = $request->alamat;

     // Save the data to the database
     if ($anggota->save()) {
         // Redirect back with a success message
         return redirect()->back()->with('success', 'Data anggota berhasil disimpan.');
     } else {
         // Redirect back with an error message
         return redirect()->back()->with('error', 'Gagal menyimpan data anggota.');
     }
 }



 public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telepon' => 'required|string|max:15',
        'angkatan' => 'required|string|max:20',
        'alamat' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Find the Anggota record by ID and update it
    $anggota = Anggota::findOrFail($id);
    $anggota->nama = $request->input('nama');
    $anggota->email = $request->input('email');
    $anggota->telepon = $request->input('telepon');
    $anggota->angkatan = $request->input('angkatan');
    $anggota->alamat = $request->input('alamat');

    if ($anggota->save()) {
        // Redirect back with success message
        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui.');
    } else {
        // Redirect back with error message
        return redirect()->back()->with('error', 'Gagal memperbarui data anggota.');
    }
}

public function destroy($id)
{
    // Find the Anggota record by ID
    $anggota = Anggota::find($id);

    if ($anggota) {
        // Delete the record
        $anggota->delete();
        return redirect()->back()->with('success', 'Data anggota berhasil dihapus.');
    } else {
        // Record not found
        return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
    }
}


public function riwayat($id_anggota) {
    $instansi = Instansi::first();  
    $anggota = Anggota::find($id_anggota); // Fetch the specific member

    if (!$anggota) {
        // Handle the case when the member is not found
        return redirect()->route('anggota')->with('error', 'Anggota tidak ditemukan');
    }

    // Fetch borrowing history for the member using Eloquent
    $peminjaman = Peminjaman::with('buku') // Assuming there is a relationship set up
        ->where('id_anggota', $id_anggota)
        ->get(['id_buku', 'tanggal_peminjaman', 'tanggal_pengembalian', 'denda']); // Select only necessary fields

    // Loop through each borrowing record to calculate and update fines
   

    return view("Petugas.Components.riwayat-peminjaman-buku", compact('instansi', 'anggota', 'peminjaman'));
}


public function show($id_anggota)
{
    // Fetch member details based on the ID
    $anggota = Anggota::find($id_anggota);

    if ($anggota) {
        // Fetch borrowing history for the member
        $peminjaman = Peminjaman::with('id_buku') // Assuming there is a relationship set in the Peminjaman model
            ->where('id_anggota', $id_anggota)
            ->get();

        // Return the view with member details and borrowing history
        return view('Petugas.Components.riwayat-peminjaman-buku', compact('anggota', 'peminjaman'));
    } else {
        // Handle the case when the member is not found
        return redirect()->back()->with('error', 'Data anggota tidak ditemukan.');
    }
}
}
