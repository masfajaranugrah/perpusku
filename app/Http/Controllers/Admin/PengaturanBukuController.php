<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;
use App\Models\Aturan_denda;
use Illuminate\Support\Facades\Validator;

class PengaturanBukuController extends Controller
{
      //index
      public function index(){
        $instansi = Instansi::first(); // You can use `first()` to get a single record
        $datajenis = Aturan_denda::all();
      
         return view("Admin.Components.pengaturan-buku", compact('instansi', 'datajenis'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'jenis' => 'required|string|max:255',
            'hari_terlambat' => 'required|integer|min:0',
            'biaya_per_hari' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
  
        // Create a new penalty rule
        Aturan_denda::create([
            'jenis' => $request->input('jenis'),
            'hari_terlambat' => $request->input('hari_terlambat'),
            'biaya_per_hari' => $request->input('biaya_per_hari'),
        ]);
     

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data jenis  berhasil tambahkan.');
    }

    public function update(Request $request, $jenis)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [

             'hari_terlambat' => 'required|integer|min:0',
            'biaya_per_hari' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the penalty rule by jenis and update it
        $aturanDenda = Aturan_denda::where('jenis', $jenis)->first();

        if (!$aturanDenda) {
            return redirect()->back()->with('error', 'Aturan denda tidak ditemukan.');
        }

        $aturanDenda->hari_terlambat = $request->input('hari_terlambat');
        $aturanDenda->biaya_per_hari = $request->input('biaya_per_hari');
        $aturanDenda->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Data jenis   berhasil diperbarui.');
    }

    public function destroy($jenis)
    {
        // Find the penalty rule by jenis
        $aturanDenda = Aturan_denda::where('jenis', $jenis)->first();

        if (!$aturanDenda) {
            return redirect()->back()->with('error', 'Tidak ditemukan.');
        }

        // Delete the penalty rule
        $aturanDenda->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'berhasil dihapus.');
    }
}
