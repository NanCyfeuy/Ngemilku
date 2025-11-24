<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi'; 
    protected $primaryKey = 'id_tempat';
    public $incrementing = true;
    public $timestamps = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nama',
        'alamat',
        'deskripsi',
        'longitude',
        'latitude',
        'hotlink',
        'gambar',
        'jam_operasional'
    ];
}

