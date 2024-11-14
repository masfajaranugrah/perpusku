<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aturan_denda extends Model
{
    use HasFactory;

    protected $table = 'aturan_denda';
    protected $primaryKey = 'jenis'; // 'jenis' sebagai primary key
    public $incrementing = false; // Pastikan ini false, karena primary key bukan integer
    protected $keyType = 'string'; // Tipe primary key adalah string

    protected $fillable = [
        'jenis',
        'hari_terlambat',
        'biaya_per_hari',
    ];
}
