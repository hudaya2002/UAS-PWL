<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Buku as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Buku extends Model
{
    protected $table='buku';    // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswa
    protected $primaryKey ='id_buku';     // Memanggil isi DB Dengan primarykey

    protected $fillable = [
        'Id_Buku',
        'Judul',
        'Penerbit',
        'Pengarang',
        'Jenis',
        'Stok', 
        
    ];
       
}
