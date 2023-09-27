<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\Document;
use App\Models\Ticket;
use App\Models\JenisDokumen;
use App\Models\Penagihan;
use App\Models\User;
use App\Models\Contract;
use App\Models\Sign;
use Haruncpi\LaravelIdGenerator\IdGenerator;
// Import ID generator for Prefix
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

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

        $data = Document::get('DocumentDescParent');
        $ticket = Ticket::findOrFail($id_ticket);
        $jenis_dokumen = JenisDokumen::all();
        $user = User::where('partner_id', $ticket->PartnerID)->first();
        $penagihan = Penagihan::where('CREATE_BY', $user->iduser)->whereIn('status', ['40', '50'])->whereNotIn('NO_PENAGIHAN', $data)->get();
        // dd($penagihan);
        $kl = Contract::where('PARTNER_ID', $ticket->PartnerID)->whereNotIn('NO_KL', $data)->get();
        $sign = Sign::get();

        return view('sirkulir.submit.add_doc', compact('id_ticket', 'ticket', 'jenis_dokumen',
         'penagihan', 'kl', 'sign'));
    }

    public function addDocument(Request $request, $id_ticket){

        $ticket = Ticket::findOrFail($id_ticket);
        $penagihan = Penagihan::where('NO_PENAGIHAN',$request->document_parent_bapl)->first();
// dd($request);
        $timezone = 'Asia/Jakarta';
        $tanggal = Carbon::now($timezone);
        $tahun = $tanggal->year;
        $waktu = $tanggal->day.$tanggal->month;
        $jam = $tanggal->hour.$tanggal->minute.$tanggal->second;
        // dd($waktu);

        $document = new Document();
        $prefix = $request->document_type.'/';
        $suffix = '/'.$ticket->PartnerID.'/'.$waktu.'/'.$jam.'/'.$tahun;
        if($request->document_type == 'BAK-BAPL' || $request->document_type == 'BAK-BAPL' || $request->document_type == 'BA-REKON'){
            $document_id = UniqueIdGenerator::generate(['table' => 'document', 'field' => 'DocumentID','length' => 33, 'prefix' => $prefix, 'suffix' => $suffix, 'reset_on_change' => 'suffix']);
        }else{
            $document_id = UniqueIdGenerator::generate(['table' => 'document', 'field' => 'DocumentID','length' => 28, 'prefix' => $prefix, 'suffix' => $suffix, 'reset_on_change' => 'suffix']);
        }
        // dd($document_id);
        $document->DocumentID = $document_id;
        $document->TicketID = $ticket->TicketID;
        $document->PartnerID = $ticket->PartnerID;
        $document->DocumentType = $request->document_type;

        if($request->document_type == 'BAK-BAPL'){
            $document->SignBy = $request->sign_by_bak_bapl;
        } elseif($request->document_type == 'BA-REKON'){
            $document->SignBy = $request->sign_by_rekon;
        } elseif($request->document_type == 'BAK-BAPLA'){
            $document->SignBy = $request->sign_by_bak_bapla;
        } elseif($request->document_type == 'BAPL'){
            $document->SignBy = $penagihan->sign_by;
        }

        $document->DocumentStatus = "10";
        $document->PicDrop = $ticket->PicDrop;
        $document->SubmitDate = $ticket->SubmitDate;
        $document->LastUpdateDate = $ticket->SubmitDate;

        if($request->document_type == 'BAK-BAPL'){
            if($request->status_sid == 'not-fbc'){
                $document->DocumentDescParent = $request->document_parent_bak_bapl." - NOT FBC";
            }else{
                $document->DocumentDescParent = $request->document_parent_bak_bapl;
            }
        }  elseif($request->document_type == 'BA-REKON'){
            $document->DocumentDescParent = strtoupper($request->document_parent_rekon);
        } elseif($request->document_type == 'BAK-BAPLA'){
            $document->DocumentDescParent = strtoupper($request->document_parent_bak_bapla);
        } elseif($request->document_type == 'BAPL'){
            $document->DocumentDescParent = $request->document_parent_bapl;
        } elseif($request->document_type == 'BAPLA'){
            $document->DocumentDescParent = strtoupper($request->document_parent_bapla);
        }

        if($request->document_type == 'BAPL'){
            $document->DocumentDescChild = $penagihan->NO_KL.' - '.$penagihan->PERIODE_DESC;
        }
        // dd($document);
        $document->save();

        return redirect()->back();
    }
}
