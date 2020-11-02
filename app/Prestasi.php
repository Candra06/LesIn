<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'table_prestasi';
    protected $fillable = ['id_tentor', 'tingkatan', 'penghargaan'];
}
