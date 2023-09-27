<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'document';
    protected $primaryKey = 'DocumentID';
    public $incrementing = 'false';
    protected $keyType = 'string';

    public function jenis_dokumen(){
        return $this->hasOne(JenisDokumen::class, 'KodeDokumen', 'DocumentType');
    }

    public function sign(){
        return $this->hasOne(Sign::class, 'sign_id', 'SignBy');
    }

}
