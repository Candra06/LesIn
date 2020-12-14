<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = ['id_tentor', 'id_kelas', 'id_siswa', 'feedback', 'rating'];
}
