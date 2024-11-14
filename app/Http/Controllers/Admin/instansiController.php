<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;
use Illuminate\Support\Facades\Storage; // Pastikan ini diimpor
  
class InstansiController extends Controller
{
    // Menampilkan daftar instansi
    public function index()
    {
        $instansi = Instansi::first(); // Ambil satu instansi jika ada
        return view("Admin.Components.instansi", compact('instansi'));
    }

    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'keterangan' => 'required|string',
    //         'logo' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Validasi file logo
    //     ]);
    
    //     $data = Instansi::first();
    
    //     if ($data) {
    //         // Update existing data
    //         $data->update($request->all());
    
    //         if ($request->hasFile('logo')) {
    //             $logoPath = $request->file('logo')->store('logos', 'public'); // Store the file
    //             $data->update(['logo' => $logoPath]); // Save the path to the DB
    //         }
    
    //         return redirect()->route('instansi')->with('success', 'Data updated successfully!');
    //     } else {
    //         // Create new record
    //         $data = Instansi::create($request->all());
    
    //         if ($request->hasFile('logo')) {
    //             $logoPath = $request->file('logo')->store('logos', 'public');
    //             $data->update(['logo' => $logoPath]);
    //         }
    
    //         return redirect()->route('instansi')->with('success', 'Data created successfully!');
    //     }
    // }
    
    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'nama' => 'required|string|max:255',
        'keterangan' => 'required|string',
        'logo' => 'nullable|file|mimes:jpg,png,jpeg|max:2048', // Validate logo file
    ]);

    // Fetch existing instance
    $data = Instansi::first();

    if ($data) {
        // Update existing data
        $data->update($request->except('logo')); // Update without logo first

        if ($request->hasFile('logo')) {
            // Remove old logo if exists
            if ($data->logo && Storage::disk('public')->exists($data->logo)) {
                Storage::disk('public')->delete($data->logo); // Delete the old logo
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data->update(['logo' => $logoPath]); // Update with new logo path
        }

        return redirect()->route('instansi')->with('success', 'Data updated successfully!');
    } else {
        // Create new record
        $data = Instansi::create($request->except('logo'));

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data->update(['logo' => $logoPath]);
        }

        return redirect()->route('instansi')->with('success', 'Data created successfully!');
    }
}


}
