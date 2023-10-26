<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    public $incrementing = 'false';

    public function document(){
        return $this->belongsTo(Document::class, 'DocumentStatus', 'id_status');
    }
}
