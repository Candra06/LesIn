<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'data_pembayaran';
    protected $fillable = ['id_kelas', 'status_pembayaran', 'harga_deal'];
}
