<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_instansi'; // Menentukan primary key jika tidak menggunakan default 'id'

    protected $table = 'instansi'; // Ensure this matches your table name
    protected $fillable = ['nama', 'keterangan', 'logo']; // Add any other fields you want to mass assign
}
