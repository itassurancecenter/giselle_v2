<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    use HasFactory;
    protected $table = 'jenis_dokumen';
    protected $primaryKey = 'KodeDokumen';
    public $incrementing = 'false';
    protected $keyType = 'string';

    public function document(){
        return $this->belongsTo(Document::class, 'DocumentType', 'KodeDokumen');
    }
}
