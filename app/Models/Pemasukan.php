<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $fillable = [
        'deskripsi',
        'jumlah',
        'tanggal',
        'waktu',
        
    ];
}
