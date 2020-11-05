<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogPembayaran extends Model
{
    protected $table = 'log_pembayaran';
    protected $fillable = ['id_pembayaran',  'bukti_tf', 'tanggal_bayar', 'jumlah_bayar', 'created_by', 'confirmed_by', 'status'];
}
