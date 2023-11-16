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
use App\Models\LogDocument;
use App\Models\File;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Alert;
use Illuminate\Support\Facades\Route;
use Storage;
// Import ID generator for Prefix
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Auth;

class Sirkulir extends Controller
{
    //
    public function createTicketView(){
        $currentDate = Carbon::now();
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
        $ticket->save();

        return redirect()->action([Sirkulir::class, 'addDocumentView'], ['id_ticket' => $ticket_id]);
     }

    public function addDocumentView($id_ticket){

        $data = Document::get('DocumentDescParent');
        $ticket = Ticket::findOrFail($id_ticket);
        $jenis_dokumen = JenisDokumen::all();
        $user = User::where('partner_id', $ticket->PartnerID)->first();
        $penagihan = Penagihan::where('CREATE_BY', $user->id)->whereIn('status', ['40', '50'])->whereNotIn('NO_PENAGIHAN', $data)->get();
        $kl = Contract::where('PARTNER_ID', $ticket->PartnerID)->whereNotIn('NO_KL', $data)->get();
        $sign = Sign::get();

        return view('sirkulir.submit.add_doc', compact('id_ticket', 'ticket', 'jenis_dokumen',
         'penagihan', 'kl', 'sign'));
    }

    public function detailTicket($id_ticket){

        $data = Document::get('DocumentDescParent');
        $ticket = Ticket::findOrFail($id_ticket);
        $jenis_dokumen = JenisDokumen::all();
        $user = User::where('partner_id', $ticket->PartnerID)->first();
        $penagihan = Penagihan::where('CREATE_BY', $user->iduser)->whereIn('status', ['40', '50'])->whereNotIn('NO_PENAGIHAN', $data)->get();
        $kl = Contract::where('PARTNER_ID', $ticket->PartnerID)->whereNotIn('NO_KL', $data)->get();
        $sign = Sign::get();

        return view('sirkulir.submit.add_doc', compact('id_ticket', 'ticket', 'jenis_dokumen',
         'penagihan', 'kl', 'sign'));
    }

    public function addDocument(Request $request, $id_ticket){

        $ticket = Ticket::findOrFail($id_ticket);
        $penagihan = Penagihan::where('NO_PENAGIHAN',$request->document_parent_bapl)->first();
        $timezone = 'Asia/Jakarta';
        $tanggal = Carbon::now($timezone);
        $tahun = $tanggal->year;
        $waktu = $tanggal->day.$tanggal->month;
        $jam = $tanggal->hour.$tanggal->minute.$tanggal->second;

        $document = new Document();
        $prefix = $request->document_type.'/';
        $suffix = '/'.$ticket->PartnerID.'/'.$waktu.'/'.$jam.'/'.$tahun;
        if($request->document_type == 'BAK-BAPL' || $request->document_type == 'BAK-BAPL' || $request->document_type == 'BA-REKON'){
            $document_id = UniqueIdGenerator::generate(['table' => 'document', 'field' => 'DocumentID','length' => 33, 'prefix' => $prefix, 'suffix' => $suffix, 'reset_on_change' => 'suffix']);
        }else{
            $document_id = UniqueIdGenerator::generate(['table' => 'document', 'field' => 'DocumentID','length' => 28, 'prefix' => $prefix, 'suffix' => $suffix, 'reset_on_change' => 'suffix']);
        }

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

        $document->DocumentStatus = "0";
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
        $document->save();

        $log = new LogDocument();
        $log->DocumentID = $document_id;
        $log->LogDesc = 'Dokumen Telah Disubmit Mitra';
        $log->status = 'Submitted';
        $log->UpdatedBy = Auth::user()->name;
        $log->save();

        Alert::success('Berhasil!', 'Dokumen Telah Berhasil Disubmit');
        return redirect()->back();
    }

    public function updateStatus($document_id)
    {
        $document = Document::findOrFail($document_id);
        $status = $document->DocumentStatus;
        $max = '9';
        if($document->SignBy == '10'){
            $maxValue = '7';
            $specialValue = '1';

            if($status == $specialValue){
                $document->DocumentStatus = $status + 2;
            }elseif($status == $maxValue || $status == $max){
                $document->DocumentStatus = $status + 0;
            }else{
                $document->DocumentStatus = $status + 1;
            }
        }elseif($document->SignBy == '20'){
            $maxValue = '2';

            if($status == $maxValue || $status == $max){
                $document->DocumentStatus = $status + 0;
            }else{
                $document->DocumentStatus = $status + 1;
            }
        }
        $document->save();

        $log = new LogDocument();
        $log->DocumentID = $document->DocumentID;
        $log->LogDesc = 'Dokumen Telah Diupdate '. $document->status->status;
        $log->status = $document->status->status;
        $log->UpdatedBy = Auth::user()->name;
        $log->save();

        Alert::success('Berhasil!', 'Status Dokumen Berhasil Diupdate');
        return redirect()->back();
    }

    public function bulkUpdateStatus(Request $request){
        $selected_document = $request->input('selected_document', []);
        $jml = sizeof($selected_document);

        foreach($selected_document as $id){
            $document = Document::find($id);
            $status = $document->DocumentStatus;
            $max = '9';
            if($document->SignBy == '10'){
                $maxValue = '7';
                $specialValue = '1';

                if($status == $specialValue){
                    $document->DocumentStatus = $status + 2;
                }elseif($status == $maxValue || $status == $max){
                    $document->DocumentStatus = $status + 0;
                }else{
                    $document->DocumentStatus = $status + 1;
                }
            }elseif($document->SignBy == '20'){
                $maxValue = '2';

                if($status == $maxValue || $status == $max){
                    $document->DocumentStatus = $status + 0;
                }else{
                    $document->DocumentStatus = $status + 1;
                }
            }
            $document->save();

            $log = new LogDocument();
            $log->DocumentID = $document->DocumentID;
            $log->LogDesc = 'Dokumen Telah Diupdate '. $document->status->status;
            $log->status = $document->status->status;
            $log->UpdatedBy = Auth::user()->name;
            $log->save();
        }

        Alert::success('Berhasil!', $jml.' Status Dokumen Berhasil Diupdate');
        return redirect()->back();
    }

    public function listSirkulir(){

        $currentRoute = Route::currentRouteName();
        // dd($currentRoute);
        if($currentRoute == 'list.sirkulir'){
            $ticket = Ticket::whereHas('sirkulir')->get();
        }elseif($currentRoute == 'list-done'){
            $ticket = Ticket::whereHas('documentDone')->get();
        }elseif($currentRoute == 'list-done-signed'){
            $ticket = Ticket::whereHas('doneSigned')->get();
        }

        return view('sirkulir.list_ticket', compact('ticket'));
    }

    public function uploadFile(Request $request, $document_id){
        $document = Document::findOrFail($document_id);
        $document->DocumentStatus = '8';
        $document->save();

        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);

        $files = new File();
        $files->DocumentID = $document->DocumentID;
        $files->Flag_status = 'S';
        $file = $request->file('file');
        $filename = 'Dokumen'. $document->id.'.pdf';
        $path = $file->storeAs('uploads', $filename, 'public');
        $files->DocumentPath = $path;
        $files->save();

        $log = new LogDocument();
        $log->DocumentID = $document->DocumentID;
        $log->LogDesc = 'Evidence Telah Disubmit';
        $log->status = $document->status->status;
        $log->UpdatedBy = Auth::user()->name;
        $log->save();

        Alert::success('Berhasil!', 'Berhasil Upload File');
        return redirect()->back();
    }

    public function acceptFile(Request $request, $document_id){
        $document = Document::findOrFail($document_id);
        $document->DocumentStatus = '9';
        $document->save();

        $log = new LogDocument();
        $log->DocumentID = $document->DocumentID;
        $log->LogDesc = $request->komentar;
        $log->status = $document->status->status;
        $log->UpdatedBy = Auth::user()->name;
        $log->save();

        Alert::success('Berhasil!', 'Dokumen Telah DIverifikasi');
        return redirect()->back();
    }

    public function rejectFile(Request $request, $document_id){
        $document = Document::findOrFail($document_id);
        $document->DocumentStatus = '10';
        $document->save();

        $log = new LogDocument();
        $log->DocumentID = $document->DocumentID;
        $log->LogDesc = $request->komentar;
        $log->status = $document->status->status;
        $log->UpdatedBy = Auth::user()->name;
        $log->save();

        Alert::success('Berhasil!', 'Dokumen Telah Dikembalikan ke Mitra');
        return redirect()->back();
    }

    public function dropDokumen($document_id){
        $document = Document::findOrFail($document_id);
        $document->delete();

        Alert::success('Berhasil!', 'Berhasil Hapus Dokumen');
        return redirect()->back();
    }

    public function returnDokumen(Request $request, $document_id){
        $document = Document::findOrFail($document_id);

        Alert::success('Berhasil!', 'Berhasil Return Dokumen');
        return redirect()->back();
    }
}
