<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $fillable = ['id_tentor', 'id_siswa', 'message', 'status'];
}
