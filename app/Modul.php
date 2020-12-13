<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = 'modul';
    protected $fillable = ['judul','id_kelas', 'id_tentor', 'file','materi'];
}
