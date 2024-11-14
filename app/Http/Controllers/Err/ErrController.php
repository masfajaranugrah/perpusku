<?php

namespace App\Http\Controllers\Err;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErrController extends Controller
{
    public function index(){
        return view('err.403.403');
    }
}
