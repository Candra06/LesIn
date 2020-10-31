<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tentor extends Model
{
    protected $table = 'data_tentor';
    protected $fillable = ['nama', 'id_akun', 'telepon','wa', 'gender', 'tgl_lahir', 'alamat'];
}
