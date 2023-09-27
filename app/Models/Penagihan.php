<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penagihan extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 't_penagihan';
    protected $primaryKey = 'ID_PENAGIHAN';

    public function dokumen(){
        return $this->belongsTo(Document::class, 'DocumentDescParent', 'NO_PENAGIHAN');
    }
}
