<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'document';

    public function jenis_dokumen(){
        return $this->hasOne(JenisDokumen::class, 'KodeDokumen', 'DocumentType');
    }

    public function sign(){
        return $this->hasOne(Sign::class, 'sign_id', 'SignBy');
    }

    public function status(){
        return $this->hasOne(Status::class, 'id_status', 'DocumentStatus');
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class, 'TicketID', 'TicketID');
    }

    public function log(){
        return $this->hasMany(LogDocument::class, 'DocumentID', 'DocumentID');
    }
}
