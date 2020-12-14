<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'rekening';
    protected $fillable = ['nomor_rekening', 'bank', 'nama_rekening', 'saldo'];
}
