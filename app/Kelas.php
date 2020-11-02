<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['id_siswa', 'id_tentor', 'id_mapel', 'tarif', 'jumlah_pertemuan', 'pertemuan', 'status'];
}
