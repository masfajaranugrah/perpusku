<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
 
 
class AuthController extends Controller
{

    // login 
    public function login(){
        return view('Auth.Login');
    }

    // public function logout(Request $request)
    // {
    //     // Hapus semua variabel sesi
    //     Session::flush();

    //     // Hapus cookie sesi jika ada
    //     if (config('session.driver') === 'cookie') {
    //         $cookieParams = session()->getCookieParams();
    //         setcookie(session_name(), '', time() - 42000,
    //             $cookieParams['path'], $cookieParams['domain'],
    //             $cookieParams['secure'], $cookieParams['httponly']
    //         );
    //     }

    //     // Hancurkan sesi
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     // Redirect ke halaman login
    //     return redirect()->route('login'); // Ganti 'login' dengan route yang sesuai
    // }
}
