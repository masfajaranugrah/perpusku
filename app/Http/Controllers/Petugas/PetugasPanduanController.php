<?php

namespace App\Http\Controllers\Petugas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;

class PetugasPanduanController extends Controller
{
     //index
     public function index(){
        $instansi = Instansi::first(); // You can use `first()` to get a single record

        return view("Petugas.Components.panduan", compact('instansi'));
    }
}
