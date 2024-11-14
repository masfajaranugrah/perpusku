<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengurus extends Authenticatable
{
    use HasFactory;
    protected $table = 'pengurus';
    protected $primaryKey = 'id_pengurus';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'email',
        'username',
        'password',
        'telepon',
        'alamat',
        'jabatan',
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];
}
