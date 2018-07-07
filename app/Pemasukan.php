<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukans';
    protected $fillable = ['id_user','jumlah'];
}
