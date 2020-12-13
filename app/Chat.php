<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'detail_chat';
    protected $fillable = ['id_room','id_tentor', 'id_siswa', 'message', 'status','created_by'];
}
