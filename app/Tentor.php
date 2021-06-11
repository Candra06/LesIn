<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tentor extends Model
{
    protected $table = 'data_tentor';
    protected $fillable = ['nama', 'id_akun', 'telepon','wa', 'gender', 'tgl_lahir', 'alamat', 'motto', 'hobi', 'saldo_dompet', 'lattitude', 'longitude', 'status', 'tarif', 'foto_ktp', 'foto_diri'];
}
