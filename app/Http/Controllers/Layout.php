<?php

namespace App\Http\Controllers;
use App\Models\Penagihan;

use Illuminate\Http\Request;

class Layout extends Controller
{
    //
    public function index(){

        return view('layout.beranda');
    }
}
