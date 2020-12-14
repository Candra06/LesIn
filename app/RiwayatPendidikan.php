<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    protected $table = 'riwayat_pendidikan';
    protected $fillable = ['id_tentor', 'jenjang_pendidikan', 'status_pendidikan', 'tahun_lulus', 'nama_sekolah', 'status'];
}
