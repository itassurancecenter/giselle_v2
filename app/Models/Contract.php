<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'm_kl';
    protected $primaryKey = 'NO_KL';
    public $incrementing = 'false';
    protected $keyType = 'string';


    public function dokumen(){
        return $this->hasOne(Document::class, 'DocumentDescParent', 'NO_KL');
    }
}
