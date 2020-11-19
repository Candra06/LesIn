<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'data_mapel';
    protected $fillable = ['mapel', 'jenjang', 'kelas', 'status'];
}
