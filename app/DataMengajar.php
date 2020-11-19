<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataMengajar extends Model
{
    protected $table ='data_mengajar';
    protected $fillable = ['id_tentor', 'id_mapel', 'status'];
}
