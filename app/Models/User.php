<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'mysql2';
    protected $table = 'user_data';
    protected $primaryKey = 'iduser';
    public $incrementing = 'false';

    public function partner(){
        return $this->hasOne(Partner::class, 'id_partner', 'partner_id');
    }
}
