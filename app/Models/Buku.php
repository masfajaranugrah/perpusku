<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
 
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    
    protected $fillable = [
        'kode_buku',
        'judul',
        'pengarang',
        'jenis',
        'jumlah',
        'tahun_terbit',
        'tersedia',
        'foto',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku', 'id_buku');
    }
 
}
