<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instansi;

class PanduanController extends Controller
{
    //index
    public function index(){
        $instansi = Instansi::first(); // You can use `first()` to get a single record

        return view("Admin.Components.panduan", compact('instansi'));
    }
}
