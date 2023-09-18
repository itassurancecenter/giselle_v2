<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\Document;
use App\Models\Ticket;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class Sirkulir extends Controller
{
    //
    public function createTicketView(){
        $currentDate = Carbon::now();
        // dd($currentDate);
        $partner = Partner::orderBy('partner_name', 'asc')->get();

        return view ('sirkulir.submit.create_ticket', compact('partner', 'currentDate'));
     }

     public function createTicket(Request $request){

        $ticket = new Ticket();
        $ticket_id = IdGenerator::generate(['table' => 'ticket', 'field' => 'TicketID','length' => 10, 'prefix' => 'GIS-', 'reset_on_prefix_change' => 'true']);
        $ticket->TicketID = $ticket_id;
        $ticket->PartnerID = $request->partner_id;
        $ticket->SubmitDate = $request->submit_date;
        $ticket->PicDrop = $request->pic_drop;
        // dd($ticket);
        $ticket->save();

        return redirect()->action([Sirkulir::class, 'addDocumentView'], ['id_ticket' => $ticket_id]);
     }

    public function addDocumentView($id_ticket){

        $ticket = Ticket::findOrFail($id_ticket);
        // dd($ticket);

        return view('sirkulir.submit.add_doc', compact('ticket'));
    }

    public function addDocument(){

    }
}
