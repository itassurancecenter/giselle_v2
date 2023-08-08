<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sirkulir extends Controller
{
    //
    public function create_ticket_view(){

        return view ('sirkulir.submit.create_ticket');
    }
}
