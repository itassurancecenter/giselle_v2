<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\User;

class Master extends Controller
{
    //
    public function dataMitra(){
        $data_mitra = Partner::orderBy('id_partner', 'asc')->get();

        return view('master.mitra', compact('data_mitra'));
    }

    public function dataUser(){
        $data_user = User::whereNot('username', 'LIKE', 'user_%')->get();

        return view('master.user', compact('data_user'));
    }
}
