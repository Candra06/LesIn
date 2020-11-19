<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'data_siswa';
    protected $fillable = ['nama', 'id_akun', 'telepon', 'gender', 'tgl_lahir', 'alamat', 'status'];
}
