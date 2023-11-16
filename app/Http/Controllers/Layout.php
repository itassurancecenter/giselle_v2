<?php

namespace App\Http\Controllers;
use App\Models\Penagihan;
use App\Models\Ticket;
use App\Models\Document;

use Illuminate\Http\Request;

class Layout extends Controller
{
    //
    public function index(){

        $ticket = Ticket::count();
        $document_sm = Document::where('SignBy', '10')->count();
        $document_mgr = Document::where('SignBy', '20')->count();
        return view('layout.beranda', compact('ticket', 'document_sm', 'document_mgr'));
    }
}
