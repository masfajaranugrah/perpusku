<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengurus;
use App\Models\Instansi;
use Illuminate\Support\Facades\Hash; // For password hashing

class PengurusController extends Controller
{
    //index
    public function index(){
        $instansi = Instansi::first(); // You can use `first()` to get a single record
        $anggota = Pengurus::all();
         return view("Admin.Components.admin", compact('anggota', 'instansi'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pengurus,email', 
            'username' => 'required|string|max:255|unique:pengurus,username',  
            'password' => 'required|string|min:8',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'jabatan' => 'required|in:Admin,Petugas',
        ]);

        // Create new Admin record
        $admin = new Pengurus();
        $admin->nama = $request->nama;
        $admin->email = $request->email;
        $admin->username = $request->username;
        // Hash the password
        $admin->password = Hash::make($request->password);
        $admin->telepon = $request->telepon;
        $admin->alamat = $request->alamat;
        $admin->jabatan = $request->jabatan;
        
        // Save the Admin data
        $admin->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Admin created successfully');
    }

public function update(Request $request, $id_pengurus)
    {
        // Validate the incoming request
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed', // Optional password
            'jabatan' => 'required|string|max:255',
        ]);

        // Find the admin by id
        $admin = Pengurus::find($id_pengurus);
        if (!$admin) {
            return redirect()->back()->withErrors('Admin not found.');
        }

        // Update admin data
        $admin->nama = $request->input('nama');
        $admin->email = $request->input('email');
        $admin->username = $request->input('username');
        $admin->telepon = $request->input('telepon');
        $admin->alamat = $request->input('alamat');
        $admin->jabatan = $request->input('jabatan');

        // Check if the password is provided, if not, keep the current password
        if (!empty($request->input('password'))) {
            $admin->password = Hash::make($request->input('password'));
        }

        // Save the updated admin
        if ($admin->save()) {
            return redirect()->back()->with('success', 'Admin updated successfully!');
        } else {
            return redirect()->back()->withErrors('Failed to update admin.');
        }
    }


    public function destroy(Request $request, $id_pengurus)
    {
        // Admin master that cannot be deleted
 
        // Check if the id_pengurus is the admin master
        if ($id_pengurus) {
            // Use Eloquent to delete the admin
            $admin = Pengurus::find($id_pengurus);

            if ($admin) {
                $admin->delete();
                return redirect()->back()->with('success', 'Admin deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Admin not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Admin master cannot be deleted.');
        }
    }
}
