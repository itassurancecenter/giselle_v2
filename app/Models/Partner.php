<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'm_partner';
    protected $primaryKey = 'id_partner';
    public $incrementing = 'false';


    public function user(){
        return $this->belongsTo(User::class, 'partner_id', 'id_partner');
    }

    public function ticket(){
        return $this->hasMany(Ticket::class, 'PartnerID', 'id_partner');
    }
}
