<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table='anggota';
    protected $primarykey='id_ag';

    protected $fillable= [
        'id_ag',
        'nama_ag',
        'alamat',
        'jenis_kelamin',
        'ttl',
        'foto',
    ];
}
