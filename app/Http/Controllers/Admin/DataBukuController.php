<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Instansi;
use App\Models\Aturan_denda;
use Illuminate\Support\Facades\Storage;


class DataBukuController extends Controller
{
    //index
    public function index(){
        $instansi = Instansi::first();  
        $jenis = Aturan_denda::all();
        $buku = Buku::all();
        return view("Admin.Components.data-buku", compact('instansi', 'jenis', 'buku'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'kode_buku' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'tahun_terbit' => 'required|integer|max:' . date('Y'),
            'tersedia' => 'required|integer|min:0|max:100000',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);
    
        // Store the uploaded file
        if ($request->hasFile('foto')) {
            // Store the file in the 'public' disk and get the file path
            $fotoPath = $request->file('foto')->store('buku', 'public'); 
        } else {
            return redirect()->back()->with('error', 'Gagal mengupload foto buku.'); // Ensure you handle this gracefully
        }
    
        // Create a new book instance
        $buku = new Buku();
    
        // Generate a random 8-digit ID (as the previous one only generated 5 digits)
        $buku->id_buku = str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT); // Ensure unique and correct ID length
        $buku->kode_buku = $request->kode_buku;
        $buku->judul = $request->judul;
        $buku->pengarang = $request->pengarang;
        $buku->jenis = $request->jenis;
        $buku->jumlah = $request->jumlah;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->tersedia = $request->tersedia;
        $buku->foto = $fotoPath;
    
        // Save the book to the database
        $buku->save(); // Ensure this line is included to save the new Buku instance
    
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan.'); // Successful message
    }
    
    public function update(Request $request, $id_buku)
    {
        // Validate the incoming request data
        $request->validate([
            'kode_buku' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'tahun_terbit' => 'required|integer',
            'tersedia' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Find the book by ID
        $buku = Buku::find($id_buku);
    
        // Handle the photo upload if a new one is provided
        if ($request->hasFile('foto')) {
            // Delete the old photo if it exists
            if ($buku->foto && Storage::disk('public')->exists($buku->foto)) {
                Storage::disk('public')->delete($buku->foto); // Delete the old foto
            }
    
            // Store new foto
            $fotoPath = $request->file('foto')->store('buku', 'public');
            $buku->foto = $fotoPath; // Update with new foto path
        }
    
        // Update other book data
        $buku->kode_buku = $request->input('kode_buku');
        $buku->judul = $request->input('judul');
        $buku->pengarang = $request->input('pengarang');
        $buku->jenis = $request->input('jenis');
        $buku->jumlah = $request->input('jumlah');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->tersedia = $request->input('tersedia');
    
        // Save the updated book data
        if ($buku->save()) {
            return redirect()->route('databuku')->with('success', 'Buku berhasil diperbarui');
        } else {
            return redirect()->route('databuku')->with('error', 'Terjadi kesalahan saat memperbarui buku.');
        }
    }
    


    public function destroy($id_buku)
{
    // Attempt to find the book using Eloquent
    $buku = Buku::find($id_buku);

    if ($buku) {
        // Check if the book has a logo and if it exists in storage
        if ($buku->foto && Storage::disk('public')->exists($buku->foto)) {
            // Delete the old logo
            Storage::disk('public')->delete($buku->foto);
         } 
        // else {
        //     dd("gagal");
        // }

        // Delete the book
        $buku->delete();

        return redirect()->back()->with('success', 'Buku dan gambar berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Buku tidak ditemukan.');
    }
}

}
