<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'ticket';
    protected $primaryKey = 'TicketID';
    public $incrementing = 'false';
    protected $keyType = 'string';

    public function partner(){
        return $this->hasOne(Partner::class, 'id_partner', 'PartnerID');
    }

    public function document(){
        return $this->hasMany(Document::class, 'TicketID', 'TicketID');
    }

    public function documentDone(){
        return $this->hasMany(Document::class, 'TicketID', 'TicketID')->where('DocumentStatus', '15');
    }

    public function doneSigned(){
        return $this->hasMany(Document::class, 'TicketID', 'TicketID')->whereIn('DocumentStatus', ['2', '7', '10', '13']);
    }

    public function sirkulir(){
        return $this->hasMany(Document::class, 'TicketID', 'TicketID')->whereNotIn('DocumentStatus', ['2', '7', '9']);
    }
}
