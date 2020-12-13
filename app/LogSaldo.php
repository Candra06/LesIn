<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogSaldo extends Model
{
    protected $table = 'log_saldo';
    protected $fillable = ['id_tentor', 'jumlah_saldo', 'jenis', 'keterangan', 'created_at'];
}
