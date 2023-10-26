<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogDocument extends Model
{
    use HasFactory;
    protected $table = 'log_document';

    public function document(){
        return $this->belongsTo(Document::class, 'DocumentID', 'DocumentID');
    }
}
