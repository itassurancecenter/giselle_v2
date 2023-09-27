<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sign extends Model
{
    use HasFactory;
    protected $table = 'sign';
    protected $primaryKey = 'sign_id';
    public $incrementing = 'false';

    public function document(){
        return $this->belongsTo(Document::class, 'SignBy', 'sign_id');
    }
}
