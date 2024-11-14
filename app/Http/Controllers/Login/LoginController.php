<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengurus;
use App\Models\Instansi;

class LoginController extends Controller
{
    //index
    public function index(){
        $instansi = Instansi::first();  
        return view('Auth.Login', compact('instansi'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
        ]);
    
        // Use Auth::attempt() for authentication
        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) { 
            
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Access the authenticated user's role
            $user = Auth::user();
         
            // Redirect based on the user's role
            if (auth()->user()->jabatan == 'Admin') {
                return redirect('/admin/dashboard')->with('success', 'Login successful.');
            } elseif (auth()->user()->jabatan == 'Petugas') {
                return redirect('/petugas/dashboard')->with('success', 'Login successful.');
            } else {
                return redirect('/login')->with('success', 'Login successful.');
            }
        }

        // Flash error message and redirect back
        $request->session()->flash('error', 'Username atau password salah!!');
        return back()->withInput($request->only('username'));
    }

public function logout(Request $request)
    {
        // Hapus semua variabel sesi
        Session::flush();

        // Hapus cookie sesi jika ada
        if (config('session.driver') === 'cookie') {
            $cookieParams = session()->getCookieParams();
            setcookie(session_name(), '', time() - 42000,
                $cookieParams['path'], $cookieParams['domain'],
                $cookieParams['secure'], $cookieParams['httponly']
            );
        }

        // Hancurkan sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect()->route('login'); // Ganti 'login' dengan route yang sesuai
    }
}
