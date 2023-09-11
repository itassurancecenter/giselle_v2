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
}